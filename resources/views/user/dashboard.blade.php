@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@if(session('status'))
<span class="text-green-600 text-sm">{{session('status')}}</span>
@endif

<div class="grid grid-cols-[auto_200px]">
    <div class="grid gap-4">
        <h1 class="heading text-xl">Welkom, {{ $user->name }}</h1>

        <h2 class="heading text-accent">Mijn advertenties</h2>
        @if($listings->isNotEmpty())
        <div class="flex flex-wrap gap-4">
            @foreach($listings as $listing)
            <div class="wrap bg-bg1 p-4 w-80 min-h-80 relative">
                <div class="min-h-20 grid gap-2">

                    <h2 class="heading text-accent">{{$listing->name}}</h2>
                    <div class="self-end flex flex-wrap gap-1">
                        @foreach($listing->categories as $category)
                        <span class="wrap px-2 py-1 bg-bg2 text-xs self-center">{{ $category->name }}</span>
                        @endforeach
                    </div>
                    <p class="mb-2">{!! nl2br(e($listing->description)) !!}</p>

                    <div class="wrap bg-bg2 h-48 mb-2 relative flex justify-center items-center">
                        <span class="text-sm italic">geen afbeelding geplaatst</span>
                        <span class="wrap bg-bg1 p-2 price text-text1 absolute bottom-2 right-2 z-40">€ {{$listing->formattedPrice()}}</span>
                    </div>

                    <div class="flex gap-2">
                        <a class="btn btn-submit text-xs italic" href="{{ route('listing.show', $listing) }}">Openen</a>
                        <a class="btn btn-submit text-xs italic" href="{{ route('listing.edit', $listing) }}">Aanpassen</a>
                        <form action="{{ route('listing.destroy', $listing) }}" method="POST" onsubmit="return confirm('Weet je het zeker? Dit kan niet ongedaan gemaakt worden!')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete text-xs font-semibold">X</button>
                        </form>
                    </div>
                    <div class="flex gap-2">
                        @if($listing->promoted)
                        <span class="text-xs font-semibold font-green-600">Advertentie gepromoot!</span>
                        @else
                        <a class="btn btn-submit text-xs italic font-semibold w-auto" href="{{ route('listing.shop', $listing) }}">Advertentie promoten</a>
                        @endif
                    </div>
                    <span class="text-xs italic absolute bottom-4 right-4">{{$listing->created_at->format('d-m-Y H:i')}}</span>
                </div>
            </div>
            @endforeach
            @else
            <span class="text-sm italic">nog geen advertentie geplaatst</span>
            @endif
        </div>

        <h1 class="heading text-accent mt-6">Mijn biedingen</h1>
        @if($bidOn->isNotEmpty())
        <div class="flex flex-wrap gap-4">
            @foreach($bidOn as $listing)
            <a class="wrap bg-bg1 p-4 w-80 min-h-80 hover:bg-bg1hover" href="{{ route('listing.show', $listing->id) }}">

                <div class="min-h-20 mb-2 grid">
                    <h2 class="heading text-accent">{{$listing->name}}</h2>
                    <div class="self-end flex flex-wrap gap-1">
                        @foreach($listing->categories->sortBy('name') as $category)
                        <span class="wrap px-2 py-1 bg-bg2 text-xs self-center">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="wrap bg-bg2 h-48 mb-2 relative flex justify-center items-center">
                    <span class="text-sm italic">geen afbeelding geplaatst</span>
                    <span class="wrap bg-bg1 p-2 price text-text1 absolute bottom-2 right-2 z-40">€ {{$listing->formattedPrice()}}</span>
                </div>

                <div class="grid grid-cols-2">
                    <div class="grid gap-0 m-0">
                        <span class="text-xs italic">Mijn bod: <span class="price text-xs">€{{$listing->biddings()->where('user_id', $user->id)->orderBy('bid', 'desc')->first()->formattedPrice('bid')}}</span></span>
                        @if($listing->biddings()->orderBy('bid', 'desc')->first()->user_id === $user->id)
                        <span class="text-xs font-semibold text-green-600">hoogste bod!</span>
                        @else
                        <span class="text-xs font-semibold text-red-700">niet hoogste bod!</span>
                        @endif
                    </div>
                    <span class="text-xs italic ml-auto self-end">{{$listing->created_at->format('d-m-Y H:i')}}</span>
                </div>

            </a>
            @endforeach

            @else
            <span class="text-sm italic">nog niet geboden</span>
            @endif

        </div>

    </div>
    <div>
        @include('partials.preferences')
    </div>
</div>

@endsection