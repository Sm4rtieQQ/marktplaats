@extends('layouts.app')

@section('title', 'Registreren')

@section('content')

<div class="w-[500px] mx-auto text-text1">
    <h1 class="heading text-accent">Nieuwe gebruiker</h1>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="wrap bg-bg1">
            <div class="p-4 grid grid-cols-[120px_auto] gap-y-4">

                <label class="font-semibold self-center" for="name">Naam</label>
                <div class="grid">
                    <input class="wrap bg-bg2 text-sm p-2" id="name" name="name" type="text" value="{{ old('name')}}">
                    @error('name')
                    <span class="text-red-700 text-sm">{{$message}}</span>
                    @enderror
                </div>

                <label class="font-semibold self-center" for="email">Email</label>
                <div class="grid">
                    <input class="wrap bg-bg2 text-sm p-2" id="email" name="email" value="{{ old('email')}}">
                    @error('email')
                    <span class="text-red-700 text-sm">{{$message}}</span>
                    @enderror
                </div>

                <label class="font-semibold self-center" for="password">Wachtwoord</label>
                <div class="grid">
                    <input class="wrap bg-bg2 text-sm p-2" id="password" name="password" type="password">
                    @error('password')
                    <span class="text-red-700 text-sm">{{$message}}</span>
                    @enderror
                </div>

                <label class="font-semibold self-center" for="password_confirmation">Bevestig wachtwoord</label>
                <div class="grid">
                    <input class="wrap bg-bg2 text-sm p-2" id="password_confirmation" name="password_confirmation" type="password">
                    @error('password_confirmation')
                    <span class="text-red-700 text-sm">{{$message}}</span>
                    @enderror
                </div>

            </div>
        </div>
        <button class="btn btn-submit mt-4" type="submit">Registreren</button>
    </form>
</div>
@endsection