@extends('layouts.app')

@section('title', 'Overzicht')

@section('content')
<div class="flex flex-wrap gap-4">

    @foreach($listings as $listing)
    <a class="wrap bg-bg1 p-4 grid w-80 min-h-80 hover:bg-bg1hover" href="{{ route('listing.show', $listing->id) }}">

        <div class="min-h-20 mb-2 grid">
            <h2 class="heading text-accent">{{$listing->name}}</h2>

            <div class="self-end">
                @foreach($listing->categories->sortBy('name') as $category)
                <span class="wrap px-2 py-1 bg-bg2 text-xs self-center">{{ $category->name }}</span>
                @endforeach
            </div>
        </div>

        <div class="wrap bg-bg2 h-48 mb-2 flex relative justify-center items-center self-end">
            <span class="text-sm italic">geen afbeelding geplaatst</span>
            <span class="wrap bg-bg1 p-2 price text-text1 absolute bottom-2 right-2 z-40">€ {{$listing->formattedPrice()}}</span>
        </div>

        <div class="grid grid-cols-2 items-end">
            <span class="text-xs">Verkoper: <strong>{{ $listing->user->name }}</strong></span>
            <span class="text-xs italic ml-auto">{{$listing->created_at->format('d-m-Y H:i')}}</span>
        </div>
    </a>
    @endforeach
</div>
@endsection