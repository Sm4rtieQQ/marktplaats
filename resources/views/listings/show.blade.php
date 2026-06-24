@extends('layouts.app')

@section('title', $listing->name)

@section('content')

@if(isset($edit))
<h2 class="heading text-accent mb-2">Advertentie aanpassen</h2>
@include('forms.edit')
@else

<div class="grid grid-cols-[auto_200px] gap-6">

    <div class="grid gap-6">

        <div class="wrap bg-bg1 p-4 relative">
            <h2 class="heading text-accent mb-2">{{$listing->name}}</h2>

            <div class="mb-2">
                @foreach($categories as $category)
                <span class="wrap px-2 py-1 bg-bg2 text-xs self-center">{{ $category->name }}</span>
                @endforeach
            </div>

            <span class="absolute top-4 right-4 text-xs italic">{{$listing->created_at->format('d-m-y h:i')}}</span>

            <p class="mb-16">{!! nl2br(e($listing->description)) !!}</p>

            <div class="absolute bottom-4 left-4 grid">
                <span class="text-sm">Aangeboden door:</span>
                <span class="font-semibold">{{$listing->user->name}}</span>
            </div>

            @can('edit', $listing)
            <div class="absolute bottom-4 right-4 grid">
                <a class="btn btn-submit" href="{{ route('listing.edit', $listing) }}">Aanpassen</a>
            </div>
            @endcan
        </div>

        <div class="grid gap-2">
            <h2 class="heading text-accent">Reacties</h2>
            @if($comments->isNotEmpty())
            @foreach($comments as $comment)
            <div class="wrap bg-bg1 p-4 relative">
                <span class="font-semibold">{{$comment->user->name}}</span>
                <span class="absolute top-4 right-4 text-xs italic">{{$comment->created_at->format('d-m-y h:i')}}</span>
                <p>{!! nl2br(e($comment->text)) !!}</p>
            </div>
            @endforeach
            @else
            <span class="text-sm italic">Nog geen reacties.</span>
            @endif
        </div>

        <div>
            <h2 class="heading text-accent">Neem deel aan het gesprek</h2>
            @auth
            <form class="grid gap-2 relative" action="{{ route('comment.store', $listing->id) }}" method="POST">
                <textarea class="wrap w-full h-64 bg-bg1 p-2" id="text" name="text"></textarea>
                <button class="btn btn-submit absolute right-4 bottom-4" type="submit">Plaats reactie!</button>
            </form>
            @error('text')
            <span class="text-xs text-red-700">{{ $message }}</span>
            @enderror
            @else
            <span class="text-sm italic">Log in om te reageren.</span>
            @endauth
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
                @auth
                <form action="{{ route('bid.store', $listing->id) }}" method="POST">
                    @csrf
                    <input class="wrap price text-md grid bg-bg1 p-2" name="bid" id="bid" />
                    @error('bid')
                    <span class="text-xs text-red-700">{{ $message }}</span>
                    @enderror
                </form>
                @else
                <span class="text-sm italic">Log in om te bieden.</span>
                @endauth
            </div>

            <div class="grid gap-2">
                <h2 class="heading text-accent">Huidige biedingen</h2>
                @if($biddings->isNotEmpty())
                @foreach($biddings as $bidding)
                <div class="wrap grid grid-cols-2 bg-bg1 p-2 px-4">
                    <div>
                        <span class="bid text-sm self-center">€ {{$bidding->formattedPrice('bid')}}</span>
                        @can('delete', $bidding)
                        <form action="{{ route('bid.destroy', $bidding) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="text-xs font-semibold text-red-700 cursor-pointer" type="submit">Intrekken</button>
                        </form>
                        @endcan
                    </div>
                    <span class="self-center font-semibold ml-auto">{{$bidding->user->name}}</span>
                </div>
                @endforeach
                @else
                <span class="text-sm italic">Nog niet geboden.</span>
                @endif
            </div>
        </div>
    </div>

</div>

@endif

@endsection