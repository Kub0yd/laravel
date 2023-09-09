<?php

namespace App\Http\Controllers\AdTech;

use App\Http\Controllers\Controller;
use App\Models\AdTech\Offer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\OfferStatus;
use App\Services\OfferService;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(Auth::check()){

            $user = Auth::user();
            $offers = Offer::where('creator_id', $user->id)->get();
            $all_offers = Offer::with(['user'])->whereNotIn('creator_id', [$user->id])->where('is_active', [true])->get();
        }
        return view('adTech.main',  compact('offers', 'all_offers'));
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
        //
        $validated = $request->validate([
            'title' => 'required',
        ]);
        try {
            // dd($request->all());
            $offer = new Offer();
            $offer->title = $request->title;
            $offer->URL = $request->URL;
            $offer->price = $request->price;
            $offer->creator_id = Auth::id();
            $offer->save();

            // OfferStatus::dispatch(array('type' => 'createOffer', 'title' => $request->title, 'URL' => $request->URL, 'price' => $request->price, 'creator' => Auth::user()->name));

        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return back();
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
