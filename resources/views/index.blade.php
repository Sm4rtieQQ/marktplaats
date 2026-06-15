@extends('layouts.app')

@section('title', 'Overzicht')

@section('content')
<div class="flex flex-wrap gap-4 justify-center">

    @foreach($listings as $listing)
    <a class="wrap bg-bg1 p-4 w-80 min-h-80 relative hover:bg-bg1hover" href="{{ route('listing.show', $listing->id) }}">
        <div>
            <h2 class="heading text-accent">{{$listing->name}}</h2>
        </div>
        <div class="wrap bg-bg2 h-48 flex justify-center items-center absolute bottom-12 left-4 right-4">
            <span class="text-sm italic">geen afbeelding geplaatst</span>
        </div>
        <span class="wrap bg-bg1 p-2 price text-text1 absolute bottom-14 right-6 z-40">€ {{$listing->formattedPrice()}}</span>
        <span class="text-xs italic absolute bottom-4 right-4">{{$listing->created_at->format('d-m-Y H:i')}}</span>
    </a>
    @endforeach
</div>
@endsection