<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use App\Http\Requests\ListingRequest;
use App\Models\Bidding;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ListingController extends Controller
{
    public function index(FilterRequest $request)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $categoryId = $request->input('category');
        $selectedCategory = Category::find($categoryId);

        $keyword = $request->input('keyword');

        $listings = Listing::when(!empty($categoryId), fn($q) => $q->withCategory($categoryId))
            ->when(!empty($keyword), fn($q) => $q->withKeyword($keyword))
            ->orderByRaw('promoted DESC, updated_at DESC')
            ->paginate(12);

        return view('index', compact('listings', 'categories', 'selectedCategory', 'keyword'));
    }

    public function create()
    {
        $listing = new Listing();
        $categories = Category::orderBy('name')->get();

        $newListing = true;

        return view('listings.create', compact('listing', 'categories', 'newListing'));
    }

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

    public function show(Listing $listing)
    {
        $biddings = Bidding::where('listing_id', $listing->id)->orderBy('bid', 'desc')->get();
        $categories = $listing->categories()->orderBy('name')->get();
        $comments = Comment::where('listing_id', $listing->id)->orderBy('created_at', 'asc')->get();

        return view('listings.show', compact('listing', 'biddings', 'categories', 'comments'));
    }

    public function edit(Listing $listing)
    {
        Gate::authorize('edit', $listing);

        $categories = Category::orderBy('name')->get();
        $edit = true;
        $newListing = false;
        $selectedCategories = $listing->categories->pluck('id')->toArray();

        return view('listings.show', compact('listing', 'categories', 'edit', 'newListing', 'selectedCategories'));
    }

    public function shop(Listing $listing)
    {
        return view('shop.promote', compact('listing'));
    }

    public function promote(Listing $listing)
    {
        Gate::authorize('edit', $listing);

        $listing->update([
            'promoted' => true,
        ]);

        return redirect()->route('user.dashboard', $listing);
    }

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

    public function destroy(Listing $listing)
    {
        Gate::authorize('edit', $listing);

        $listing->delete();

        return redirect()->route('user.dashboard');
    }
}
