<?php

namespace App\Http\Controllers\AdTech;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\AdTech\Offer;
use App\Models\AdTech\Sub;
use App\Models\AdTech\Role;
use App\Models\AdTech\Permission;

use App\Services\OfferService;
use App\Services\SubService;
use App\Services\DispatchService;


class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(Auth::check()){

            $user = Auth::user();
            $offers = Offer::where('creator_id', $user->id)->get();
            $userId = $user->id;
            $allOffers = Offer::where('creator_id', '<>', $userId)
                ->whereDoesntHave('subs', function ($query) use ($userId) {
                    $query->where('user_id', $userId)->where('is_active', true);
                })
                ->where('is_active', true)
                ->get();
            $userSubs = $user->subs->where('is_active', true);

        }
        return view('adTech.main',  compact('offers', 'userSubs', 'allOffers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        switch ($request->type) {
            case 'subscription':
                (new SubService())->subscribe($request);
                return back();
                break;

            case 'unsubscribe':
                (new SubService())->unsubscribe($request);
                return back();
                break;

            default:
                $validated = $request->validate([
                    'title' => 'required',
                    'URL' => 'required',
                    'price' => 'required',
                ]);
                (new OfferService())->createOffer($request);
                return back();
                break;
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, offer $offer)
    {
        //
        switch ($request->type) {
            case 'offerStatus':
                (new OfferService())->updateOfferStatus($request);
                break;

            default:
                # code...
                break;
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(offer $offer)
    {
        //
    }

}
