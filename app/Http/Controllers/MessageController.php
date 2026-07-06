<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Mail\NewMessage;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function store(MessageRequest $request, Chat $chat)
    {
        $sender = Auth::user();
        $receiver = $sender->id === $chat->sender_uid ? $chat->receiver : $chat->sender;

        Message::create([
            'chat_id' => $chat->id,
            'user_id' => $sender->id,
            'text' => $request->input('text'),
        ]);

        if ($receiver->notifications) {
            Mail::send(new NewMessage($receiver, $sender, $chat));
        }

        return back();
    }
}
