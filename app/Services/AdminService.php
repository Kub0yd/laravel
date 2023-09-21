<?php
namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\AdTech\Offer;
use App\Models\AdTech\Sub;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\AdminEvent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AdminService
{
    public function sendInfo($request)
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
        $test  = [
            'type' => 'sendOfferInfo',
            'offer' => $offerUserInfo,
        ];
        AdminEvent::dispatch($test);
        // event(new AdminEvent(array('type' => 'error',)));

    }
}
