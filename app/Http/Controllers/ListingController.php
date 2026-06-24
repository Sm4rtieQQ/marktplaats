<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListingRequest;
use App\Models\Bidding;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        $listing = new Listing();
        $categories = Category::orderBy('name')->get();

        $newListing = true;

        return view('listings.create', compact('listing', 'categories', 'newListing'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ListingRequest $request)
    {
        $listing = Listing::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'user_id' => Auth::user()->id,
        ]);

        $categories = $request->input('categories', []);
        $listing->categories()->attach($categories);

        return redirect()->route('listings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        $biddings = Bidding::where('listing_id', $listing->id)->orderBy('bid', 'desc')->get();
        $categories = $listing->categories()->orderBy('name')->get();
        $comments = Comment::where('listing_id', $listing->id)->orderBy('created_at', 'asc')->get();

        return view('listings.show', compact('listing', 'biddings', 'categories', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        Gate::authorize('edit', $listing);

        $categories = Category::orderBy('name')->get();
        $edit = true;
        $newListing = false;
        $selectedCategories = $listing->categories->pluck('id')->toArray();

        return view('listings.show', compact('listing', 'categories', 'edit', 'newListing', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ListingRequest $request, Listing $listing)
    {
        Gate::authorize('edit', $listing);

        $newData = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ];
        $categories = $request->input('categories', []);

        $listing->update($newData);
        $listing->categories()->sync($categories);

        return redirect()->route('listing.show', $listing);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        Gate::authorize('edit', $listing);

        $listing->biddings()->delete();
        $listing->comments()->delete();
        $listing->delete();

        return redirect()->route('user.dashboard');
    }
}
