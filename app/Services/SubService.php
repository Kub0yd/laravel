<?php
namespace App\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\AdTech\Offer;
use App\Models\AdTech\Sub;
use App\Models\User;

use App\Events\OfferStatus;

use App\Services\DispatchService;

class SubService
{
    public function subscribe($request)
    {
        $offer = Offer::find($request->offer_id);
        if ($offer->is_active){
            //проверям была ли уже подписка на оффер
            if (Auth::user()->subs()->where('offer_id', $offer->id)->where('is_active', false)->get()->count())
            {
                $sub = Auth::user()->subs()->where('offer_id', $offer->id)->first();
                $sub->is_active = true;
                $sub->save();
            }else{
                //иначе создаем новую запись
                $sub = new Sub();
                $sub->offer_id = $request->offer_id;
                $sub->user_id = Auth::id();
                $sub->link = url("/redirect/".Str::random($length = 16));
                $sub->is_active = true;
                $sub->save();
            }
            $sub = Auth::user()->subs()->where('offer_id', $offer->id)->first();
            $offerResponseData = [
                'offer_id' => $offer->id,
                'offer_url' => $offer->URL,
                'offer_subs' => $offer->subs->where('is_active', true)->count(),
            ];
            $response = DispatchService::createResponse('subStatus', $offerResponseData);
            DispatchService::OfferStatusChannelSend( $response);

            $userSubUpdateData = [
                'sub_id' => $sub->id,
                'sub_url' => $sub->link,
                'offer_id' => $offer->id,
            ];
            DispatchService::UserChannelSend(Auth::id(), DispatchService::createResponse('subInfo', $userSubUpdateData));

        }

    }

    public function unsubscribe($request)
    {
        // dd($request);
        $offer = Offer::find($request->offer_id);

        if (Auth::user()->subs()->where('offer_id', $offer->id)->where('is_active', true)->get()->count())
            {

                $sub = Auth::user()->subs()->where('offer_id', $offer->id)->first();
                $sub->is_active = false;
                $sub->save();

                $offerResponseData = [
                    'offer_id' => $offer->id,
                    'offer_subs' => $offer->subs->where('is_active', true)->count()
                ];
                DispatchService::OfferStatusChannelSend(DispatchService::createResponse('subStatus', $offerResponseData));
            }else{
                //ex
            }

    }
    public function sendUpdates($request)
    {
        $offer = Offer::find($request->offer_id);
        $user = User::find($request->user_id);
        if ($offer){
                $data = [
                'offer_id' => $offer->id,
                'income' => $offer->transactions->where('user_id', $user->id)->sum('cost') * 0.8,
                'offer_subs' => $offer->subs->where('is_active', true)->count(),
            ];
            DispatchService::UserChannelSend($user->id, DispatchService::createResponse('updateOfferData', $data));
        }

    }

}

