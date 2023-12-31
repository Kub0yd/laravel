<?php
namespace App\Services;


use App\Models\AdTech\Offer;
use App\Models\AdTech\Role;
use App\Models\User;

use App\Services\DispatchService;


class AdminService
{
    public function sendOfferInfo($request)
    {

        $offer = Offer::find(intVal($request->offer_id));
        $offerSubsList = $offer->subs;
        $offerUserInfo = [];
        foreach ($offerSubsList as $sub){
            $user = User::find($sub->user_id);
            $userOfferIncome = $user->transactions->where('offer_id', $sub->offer_id)->sum('cost') *0.8;
            $offerUserInfo[] = [
                'user_name' => $user->name,
                'user_id' => $user->id,
                'user_income' => $userOfferIncome,
                'user_roles' => $user->roles->all(),
                'user_personalURL' => $user->subs()->where('offer_id', $offer->id)->value('link'),
                "is_active" => $sub->is_active,
            ];
        }

        DispatchService::AdminChannelSend(DispatchService::createResponse('sendOfferInfo', $offerUserInfo));

        // event(new AdminEvent(array('type' => 'error',)));

    }
    //Получаем Подписки и Офферы юзера
    public function sendUserInfo($request)
    {
        $user = User::where('name', $request->user_name)->first();
        $userSubs = $user->subs;
        $userOffers = Offer::where('creator_id', $user->id)->get();
        $subInfo = [];
        // $userOffersData = [];
        $subInfo[] = [
            'user_name' => $user->name,
            'user_id' => $user->id,
            'user_roles' => $user->roles->pluck('name'),
            'user_income' => round($user->transactions->sum('cost') * 0.8, 2),
            'user_transactions' =>$user->transactions->count(),
        ];
        foreach ($userSubs as $sub)
        {
            $subOffer = Offer::find($sub->offer_id);
            $offerCreator = User::find($subOffer->creator_id);
            $subTransactionsCOunt = $user->transactions->where('offer_id', $subOffer->id)->count();
            $subIncome = $user->transactions->where('offer_id', $subOffer->id)->sum('cost') *0.8;
            $subInfo[] = [
                'sub_data' => [
                    'offer_title' => $subOffer->title,
                    'offer_id' => $subOffer->id,
                    'offer_creator' => $offerCreator->name,
                    'user_personalURL' => $sub->link,
                    "is_active" => $sub->is_active,
                    "sub_income" => round($subIncome, 2),
                    "sub_transactions" => $subTransactionsCOunt,
                ],
            ];
        }
        foreach ($userOffers as $offer)
        {
            $offerSubs = $offer->subs->count();
            $offerLoss = $offer->transactions->sum('cost');
            $subInfo[] = [
                'offer_data' => [
                    'is_active' => $offer->is_active,
                    'offer_id' => $offer->id,
                    'offer_title' => $offer->title,
                    'offer_URL' => $offer->URL,
                    'offer_price' => $offer->price,
                    'offer_subs' => $offerSubs,
                    'offer_loss' => $offerLoss,
                ],
            ];
        }


        $response = DispatchService::createResponse('sendUserInfo', $subInfo);
        DispatchService::AdminChannelSend($response);
    }
    public function updateUserRoles($request)
    {
        $user = User::find($request->user_id);
        $user->permissions()->detach();
        $user->roles()->detach();
        if ($request->user_roles){
            foreach ($request->user_roles as $role) {

                // (new UserService())->assignRole($user, $role);

                $this->assignRole($user, $role);

            }
        }

    }
    protected function assignRole($user, $roleName)
    {
        $role = Role::where('name', $roleName)->first();
        // $response = DispatchService::createResponse('test', $role);
        // DispatchService::AdminChannelSend($response);
        $user->roles()->attach($role);
        $permissions = $role->permissions;
        $user->permissions()->attach($permissions);
    }
    public function sendOfferErrors($request)
    {
        $offer = Offer::find($request->offer_id);
        $subs = $offer->subs()->get();
        $badTransactions = [];

        foreach ($subs as $sub) {
            # code...
            $errors = $sub->badTransactions()->get();
            $badTransactions[] = [
                'sub_id' => $sub->id,
                'webmaster' => $sub->user()->first()->name,
                'errors' => $errors,
            ];
            // DispatchService::AdminChannelSend(DispatchService::createResponse('error', $sub->user()->first()->name));
        }
        $response = DispatchService::createResponse('sendOfferErrors', $badTransactions);
        DispatchService::AdminChannelSend($response);

    }
}

