@extends('layouts.app')

@section('title', $listing->name)

@section('content')
<div class="grid grid-cols-[auto_200px] gap-6 text-text1">

    <div>

        <div class="wrap bg-bg1 p-4 relative mb-6">
            <h2 class="heading text-accent mb-2">{{$listing->name}}</h2>
            <span class="absolute top-4 right-4 text-xs italic">{{$listing->created_at->format('d-m-y h:i')}}</span>
            <p class="mb-16">{{$listing->description}}</p>
            <div class="absolute bottom-4 left-4 grid">
                <span class="text-sm">Aangeboden door:</span>
                <span class="font-semibold">{{$listing->user->name}}</span>
            </div>
        </div>

        <div class="grid gap-2">
            <h2 class="heading text-accent">Reacties</h2>
            @if($comments->isNotEmpty())
            @foreach($comments as $comment)
            <div class="wrap bg-bg1 p-4 relative">
                <span class="font-semibold">{{$comment->user->name}}</span>
                <span class="absolute top-4 right-4 text-xs italic">{{$comment->created_at->format('d-m-y h:i')}}</span>
                <p>{{$comment->text}}</p>
            </div>
            @endforeach
            @else
            <span class="text-sm italic">Nog geen reacties.</span>
            @endif
        </div>
    </div>

    <div>
        <div class="grid gap-6">
            <div>
                <h2 class="heading text-accent">Vraagprijs</h2>
                <span class="wrap grid bg-bg1 p-2 price text-accent">€ {{$listing->formattedPrice()}}</span>
            </div>

            <div>
                <h2 class="heading text-accent">Bod plaatsen</h2>
                <input class="wrap grid bg-bg1 p-2" />
            </div>

            <div>
                <h2 class="heading text-accent">Huidige biedingen</h2>
                @if($biddings->isNotEmpty())
                @foreach($biddings as $bidding)
                <div class="wrap grid grid-cols-2 bg-bg1 p-2">
                    <span class="bid text-sm self-center">€ {{$bidding->formattedPrice('bid')}}</span>
                    <span class="self-center font-semibold">{{$bidding->user->name}}</span>
                </div>
                @endforeach
                @else
                <span class="text-sm italic">Nog niet geboden.</span>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection