@extends('layouts.app')

@section('title', 'Chats')

@section('content')

<h2 class="heading text-accent mb-2">Chat</h2>
<div class="wrap bg-bg2 grid gap-4 p-4">
    @foreach( $chats as $chat )
    <div class="wrap bg-bg1">
        <p>{{ $chat }}</p>
    </div>
    @endforeach
</div>
@endsection