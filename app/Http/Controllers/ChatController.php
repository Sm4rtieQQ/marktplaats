<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Listing;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ChatController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $receivedChats = Chat::where('receiver_uid', $userId)
        ->whereHas('messages')
        ->orderBy('updated_at', 'desc')
        ->get();

        $sendChats = Chat::where('sender_uid', $userId)
        ->whereHas('messages')
        ->withMax('messages', 'created_at')
        ->orderByDesc('messages_max_created_at')
        ->get();

        return view('chats.index', compact('receivedChats', 'sendChats'));
    }

    public function show(Chat $chat)
    {
        Gate::authorize('view', $chat);

        $user = Auth::user();
        $chattingWith = $chat->sender_uid === $user->id ? $chat->receiver : $chat->sender;

        $messages = Message::where('chat_id', $chat->id)->get();
        return view('chats.show', compact('chat', 'chattingWith', 'messages'));
    }

    public function store(Listing $listing)
    {
        $sender = Auth::user()->id;
        $receiver = $listing->user->id;

        $chat = Chat::firstOrCreate([
            'listing_id' => $listing->id,
            'receiver_uid' => $receiver,
            'sender_uid' => $sender,
        ]);
        return redirect()->route('chat.show', compact('chat'));
    }
}
