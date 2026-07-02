<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(MessageRequest $request, Chat $chat)
    {
        Message::create([
            'chat_id' => $chat->id,
            'user_id' => Auth::user()->id,
            'text' => $request->input('text'),
        ]);
        return back();
    }
}
