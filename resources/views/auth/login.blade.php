@extends('layouts.app')

@section('title', 'Inloggen')

@section('content')
<div class="w-[500px] mx-auto grid gap-2">

    <form action="{{route('user.auth')}}" method="POST">
        @csrf
        <h1 class="heading text-accent">Inloggen</h1>
        @if(session('status'))
        <span class="text-green-600 text-sm">{{ session('status') }}</span>
        @endif
        <div class="wrap bg-bg1 p-4">

            <div class="grid grid-cols-[120px_auto] gap-y-4">

                <label class="font-semibold self-center" for="email">Email</label>
                <div class="grid">
                    <input class="wrap bg-bg2 p-2 text-sm" id="email" name="email" value="{{ old('email')}}">
                    @error('email')
                    <span class="text-red-700 text-sm">{{$message}}</span>
                    @enderror
                </div>

                <label class="font-semibold self-center" for="password">Wachtwoord</label>
                <div class="grid">
                    <input class="wrap bg-bg2 p-2 text-sm" id="password" name="password" type="password">
                    @error('password')
                    <span class="text-red-700 text-sm">{{$message}}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="flex gap-2 mt-4">
            <button class="btn btn-submit" type="submit">Inloggen</button>
            <a class="btn btn-cancel" href="{{route('user.register')}}">Registreren</a>
        </div>
    </form>
    <a class="text-sm underline" href="{{ route('password.request') }}">Wachtwoord vergeten?</a>
</div>
@endsection