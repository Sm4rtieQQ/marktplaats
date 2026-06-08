@extends('layouts.app')

@section('title', 'Overzicht')

@section('content')
<div class="grid grid-cols gap-4">
    <p>hier komt een overzicht van alle artikelen</p>
    @foreach($listings as $listing)
    <span>{{$listing->name}}</span>
    @endforeach
</div>
@endsection