<?php

namespace App\Http\Controllers\AdTech;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\AdTech\Offer;
use App\Events\AdminEvent;
use App\Services\AdminService;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
Use DB;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        // dd($user->roles->all());
        if ($user->hasPermissions('administration')){
            $offers = Offer::orderBy('id')->cursorPaginate(15);
            $allUsers = User::orderBy('id')->cursorPaginate(6);
            return view('adTech.adminPanel',  compact('offers', 'allUsers'));


        }else{
            abort(404);
        }
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
        // (new AdminService())->sendInfo($request);
        if ($request->type === "getOfferInfo"){
            (new AdminService())->sendInfo($request);
        }else{

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
