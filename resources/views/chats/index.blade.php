@extends('layouts.app')

@section('title', 'Chats')

@section('content')
<div class="max-w-[500px] mx-auto grid gap-6">
    <div>
        <h2 class="heading text-accent mb-2">Mijn ontvangen chats</h2>
        @if($receivedChats->isNotEmpty())
        <div class="wrap bg-bg2 grid gap-4 p-4">
            @foreach( $receivedChats as $chat )
            <a class="wrap bg-bg1 hover:bg-bg1hover cursor-pointer p-2 relative grid gap-2" href="{{ route('chat.show', $chat->id) }}">
                <h4 class="text-accent font-semibold">{{ $chat->sender->name }}</h4>
                <div class="absolute top-2 right-2 text-xs">
                    <span>Laatste bericht:</span><br />
                    <span class="italic">{{ date('d-m-Y H:i', strtotime($chat->messages_max_created_at)) }}</span>
                </div>
                <span class="font-semibold">{{ $chat->listing->name }}</span>
            </a>
            @endforeach
        </div>
        @else
        <span class="italic text-sm">Nog geen chats ontvangen.</span>
        @endif
    </div>

    <div>
        <h2 class="heading text-accent mb-2">Mijn verstuurde chats</h2>
        @if($sendChats->isNotEmpty())
        <div class="wrap bg-bg2 grid gap-4 p-4">
            @foreach( $sendChats as $chat )
            <a class="wrap bg-bg1 hover:bg-bg1hover cursor-pointer p-2 relative grid gap-2" href="{{ route('chat.show', $chat->id) }}">
                <h4 class="text-accent font-semibold">{{ $chat->receiver->name }}</h4>
                <div class="absolute top-2 right-2 text-xs">
                    <span>Laatste bericht:</span><br />
                    <span class="italic">{{ date('d-m-Y H:i', strtotime($chat->messages_max_created_at)) }}</span>
                </div>
                <span class="font-semibold">{{ $chat->listing->name }}</span>
            </a>
            @endforeach
        </div>
        @else
        <span class="italic text-sm">Nog geen chats verstuurd.</span>
        @endif
    </div>
</div>

@endsection