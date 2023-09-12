<?php

namespace App\Http\Controllers\AdTech;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\AdTech\Offer;
use App\Models\AdTech\Sub;
use App\Models\AdTech\Transaction;


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
            return redirect($offerInfo->URL);


        }else{
            abort(404);
        }
    }
}
