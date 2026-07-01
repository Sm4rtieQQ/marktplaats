<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Auth::user()->chats()
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('chats.index', compact('chats'));
    }

    public function show(Chat $chat)
    {
        return view('chats.show', compact('chat'));
    }
}
