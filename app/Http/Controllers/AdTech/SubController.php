<?php

namespace App\Http\Controllers\AdTech;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdTech\Sub;
use App\Models\AdTech\Offer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class SubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sub $sub)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sub $sub)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sub $sub)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sub $sub)
    {
        //
    }
}
