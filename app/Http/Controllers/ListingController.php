<?php

namespace App\Http\Controllers;

use App\Models\Bidding;
use App\Models\Comment;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listings = Listing::orderBy('created_at', 'desc')->get();
        return view('index', compact('listings'));
    }

    /**np
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $listing = new Listing();
        $listing->fill([
            "name" => $request->input('name'),
            "description" => $request->input('description'),
            "price" => $request->input('price'),
            "user_id" => 1,
        ]);

        $listing->save();
        return redirect()->route('listings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        $biddings = Bidding::where('listing_id', $listing->id)->orderBy('bid', 'desc')->get();
        $comments = Comment::where('listing_id', $listing->id)->orderBy('created_at', 'asc')->get();

        return view('listings.show', compact('listing', 'biddings', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //
    }
}
