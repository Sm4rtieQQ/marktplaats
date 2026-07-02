@extends('layouts.app')

@section('title', 'chat')

@section('content')

<div class="max-w-[500px] mx-auto grid gap-2">
    <div class="wrap bg-bg2 p-2">
        <h2 class="heading text-accent">{{ $chattingWith->name }}</h2>
        <a class="text-accent font-semibold underline" href="{{ route('listing.show', $chat->listing) }}">{{ $chat->listing->name }}</a>
        <div class="grid p-2 gap-2">
            @foreach($messages as $message)
            @if($message->user_id === $chattingWith->id)
            <div class="wrap bg-bg2 p-2 mr-20">
                <p>{!! nl2br(e($message->text)) !!}</p>
                <span class="text-xs italic">{{ $message->created_at->format('d-m H:i') }}</span>
            </div>
            @else
            <div class="wrap bg-bg1 p-2 ml-20">
                <p>{!! nl2br(e($message->text)) !!}</p>
                <span class="text-xs italic">{{ $message->created_at->format('d-m H:i') }}</span>
            </div>
            @endif
            @endforeach
            <form class="relative grid" action="{{ route('message.store', $chat) }}" method="POST">
                @csrf
                <input class="wrap bg-bg1 p-2 ml-20" type="text" name="text" id="text" autofocus />
                <button class="wrap btn-submit absolute right-2 self-center cursor-pointer py-1 px-2" type="submit">⇑</button>
            </form>
        </div>
    </div>
</div>
@endsection