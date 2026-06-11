@extends('layouts.app')

@section('title', 'Inloggen')

@section('content')
<div class="w-[500px] mx-auto text-text1">
    <h1 class="heading text-accent">Inloggen</h1>

    <form action="{{route('user.auth')}}" method="POST">
        @csrf
        <div class="wrap bg-bg1">
            @if(session('success'))
            <span class="text-green-600 text-sm">{{session('success')}}</span>
            @endif
            <div class="grid grid-cols-[120px_auto] p-4 gap-y-4">

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
</div>
@endsection