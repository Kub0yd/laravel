<?php
namespace App\Services;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdTech\OfferController;
use App\Models\AdTech\Offer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\OfferStatus;


class OfferService
{
    public function updateOfferStatus($requestData)
    {

        $offerId = $requestData->offer_id;
        $offer = Offer::find($offerId);

        if (Auth::user()->id == $offer->creator_id){
            $offer->is_active = $requestData->is_active;
            $offer->save();
            // OfferStatus::dispatch(json_encode(array('type' => 'offerStatus', 'offer_id' => $offer->id, 'is_active' => $offer->is_active)));
            OfferStatus::dispatch([
                'type' => 'offerStatus',
                'offer_id' => $offerId,
                'is_active' => $offer->is_active,
                'price' => $offer->price,
                'creator' => Auth::user()->name,
                'title' => $offer->title,
                'URL' => $offer->URL]);
        }
        else {
            OfferStatus::dispatch(array('type' => 'error', 'user' => Auth::user()->name, 'offer' => $offer->title ));
        }

        // OfferStatus::dispatch(json_encode(array('undec_id' => $id)));
    }
}
