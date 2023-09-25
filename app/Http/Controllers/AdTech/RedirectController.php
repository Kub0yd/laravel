<?php

namespace App\Http\Controllers\AdTech;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\AdTech\Offer;
use App\Models\AdTech\Sub;
use App\Models\AdTech\Transaction;
use App\Events\UserEvent;
use App\Models\User;
use App\Events\OfferStatus;

class RedirectController extends Controller
{
    //
    public function redirect(Request $request)
    {
        // $offerInfo = DB::table('offers')
        //     ->join('subs', 'offers.id', '=', 'subs.offer_id')
        //     ->where('subs.link', '=', url()->current())
        //     ->first();
        $sub = Sub::where('link', url()->current())->first();
        $offer = Offer::find($sub->offer_id);
            OfferStatus::dispatch(['sub' => $sub, 'offer' => $offer]);
        // dd($request->ip());
        if ($sub->is_active && $offer->is_active){
            $transaction = new Transaction();
            $transaction->offer_id = $offer->id;
            $transaction->user_id = $sub->user_id;
            $transaction->cost = $offer->price;

            $transaction->save();
            $income = [
                'type' => 'income',
                'offer_id' => $offer->id,
                //множитель вынести отдельно
                'income' => ($offer->price)*0.8

            ];
            $loss = [
                'type' => 'loss',
                'offer_id' => $offer->id,
                'loss' => $offer->price

            ];

            event(new \App\Events\UserEvent(User::find($sub->user_id), $income));
            event(new \App\Events\UserEvent(User::find($offer->creator_id), $loss));

            return redirect($offer->URL);


        }else{
            abort(404);
        }
    }
}
