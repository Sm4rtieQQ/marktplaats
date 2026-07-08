@extends('layouts.app')

@section('title', 'Overzicht')

@section('content')
<h1 class="heading text-accent mb-4">Advertenties</h1>

@if($listings->isNotEmpty())
<span class="text-xs italic">Gevonden advertenties: {{ $listings->total() }}</span>
@else
<span class="text-xs italic">Geen advertenties gevonden.</span>
@endif

<div class="grid grid-cols-[auto_140px]">
    <div>
        <div class="flex flex-wrap gap-4 mb-4">

            @foreach($listings as $listing)
            <a class="wrap bg-bg1 p-4 grid w-80 min-h-80 hover:bg-bg1hover" href="{{ route('listing.show', $listing->id) }}">

                <div class="min-h-20 mb-2 grid">
                    <h2 class="heading text-accent">{{ $listing->name }}</h2>
                    @if($listing->promoted)
                    <span class="text-xs italic">Gepromoot</span>
                    @endif
                    <div class="flex flex-wrap self-end gap-1">
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
        <div class="ml-auto mr-[140px]">
            {{ $listings->appends(request()->query())->links() }}
        </div>
    </div>

    <div class="text-sm">
        @include('partials.filter')
    </div>
</div>

@endsection