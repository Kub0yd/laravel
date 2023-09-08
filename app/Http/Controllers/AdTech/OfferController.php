<?php

namespace App\Http\Controllers\AdTech;

use App\Http\Controllers\Controller;
use App\Models\AdTech\Offer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\OfferStatus;

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

        $data = $request->toArray();
        $id = $request->offer_id;
        $offerData = Offer::find($id);
        $offerData->is_active = $data->is_active;
        // $offerData->save();

        // OfferStatus::dispatch(json_encode(array('offer_id' => $offerData->id, 'is_active' => $offerData->isActive)));
        // return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(offer $offer)
    {
        //
    }
}
