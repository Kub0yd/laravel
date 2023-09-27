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
use App\Services\DispatchService;
use Illuminate\Support\Facades\Log;

class RedirectController extends Controller
{
    //
    public function redirect(Request $request)
    {

        $sub = Sub::where('link', url()->current())->first();
        $offer = Offer::find($sub->offer_id);
            // OfferStatus::dispatch(['sub' => $sub, 'offer' => $offer]);
        // dd($request->ip());
        // dd(!!($sub->is_active));
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
            $data = [
                'offer_id' => $offer->id,
                'loss' => $offer->price,
                'income' => ($offer->price)*0.8,
            ];
            DispatchService::AdminChannelSend(DispatchService::createResponse('transaction', $data));
            event(new \App\Events\UserEvent(User::find($sub->user_id), $income));
            event(new \App\Events\UserEvent(User::find($offer->creator_id), $loss));

            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/test.log'),
              ])->info('Transaction offer_id:'.$offer->id.", from webmaster:".$sub->user->name);
              abort(404);

            return redirect($offer->URL);

        }else{
            abort(404);
        }
    }
}
