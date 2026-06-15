<?php

namespace App\Http\Controllers;

use App\Models\Bidding;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiddingController extends Controller
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
    public function store(Request $request, Listing $listing)
    {
        Bidding::create([
            'listing_id' => $listing->id,
            'user_id' => Auth::user()->id,
            'bid' => $request['bid'],
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Bidding $bidding)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bidding $bidding)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bidding $bidding)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bidding $bidding)
    {
        //
    }
}
