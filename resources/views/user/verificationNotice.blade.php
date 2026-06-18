@extends('layouts.app')

@section('title', 'Email bevestigen')

@section('content')
<div class="w-[500px] mx-auto">
    <h1 class="heading text-accent">Bevestig uw email adres</h1>

    @if(session('success'))
    <span class="text-sm text-green-600">{{ session('success') }}</span>
    @endif

    <p>
        Er is een link gestuurd naar <strong>{{ auth()->user()->email }}</strong><br />
        Klik deze link om uw email adres te bevestigen en uw account te activeren!
    </p>

    <form action="{{route('verification.send')}}" method="POST">
        @csrf
        <button class="font-semibold cursor-pointer" type="submit">Klik hier voor een nieuwe link</button>
    </form>

    @if(session('message'))
    <span class="text-sm text-green-600">{{ session('message') }}</span>
    @endif
</div>
@endsection