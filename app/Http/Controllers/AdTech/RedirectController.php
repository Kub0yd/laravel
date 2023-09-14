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

class RedirectController extends Controller
{
    //
    public function redirect(Request $request)
    {
        $offerInfo = DB::table('offers')
            ->join('subs', 'offers.id', '=', 'subs.offer_id')
            ->where('subs.link', '=', url()->current())
            ->first();

        // dd($request->ip());
        if ($offerInfo && $offerInfo->is_active){
            $transaction = new Transaction();
            $transaction->offer_id = $offerInfo->offer_id;
            $transaction->user_id = $offerInfo->user_id;
            $transaction->cost = $offerInfo->price;

            $transaction->save();
            $income = [
                'type' => 'income',
                'offer_id' => $offerInfo->offer_id,
                //множитель вынести отдельно
                'income' => ($offerInfo->price)*0.8

            ];
            $loss = [
                'type' => 'loss',
                'offer_id' => $offerInfo->offer_id,
                'loss' => $offerInfo->price

            ];

            event(new \App\Events\UserEvent(User::find($offerInfo->user_id), $income));
            event(new \App\Events\UserEvent(User::find($offerInfo->creator_id), $loss));

            return redirect($offerInfo->URL);


        }else{
            abort(404);
        }
    }
}
