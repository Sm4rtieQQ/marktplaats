<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Listing $listing)
    {
        Comment::create([
            'listing_id' => $listing->id,
            'user_id' => Auth::user()->id,
            'text' => $request->input('text'),
        ]);

        return redirect()->back();
    }
}
