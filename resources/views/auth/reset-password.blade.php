@extends('layouts.app')

@section('title', 'Nieuw wachtwoord')

@section('content')
<div class="w-[500px] mx-auto grid gap-2">

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <h1 class="heading text-accent">Nieuw wachtwoord</h1>

        <input type="hidden" name="token" id="token" value="{{ $token }}" />

        <div class="wrap bg-bg1 p-4">
            <div class="grid grid-cols-[120px_auto] gap-y-4">

                <label class="font-semibold self-center" for="email">Email</label>
                <div class="grid">
                    <input class="wrap bg-bg2 p-2 text-sm" name="email" id="email" value="{{ old('email') }}" />
                    @error('email')
                    <span class="text-red-700 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <label class="font-semibold self-center" for="password">Nieuw wachtwoord</label>
                <div class="grid">
                    <input class="wrap bg-bg2 p-2 text-sm" id="password" name="password" type="password" value="{{ old('password')}}">
                    @error('password')
                    <span class="text-red-700 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <label class="font-semibold self-center" for="password_confirmation">Bevestig wachtwoord</label>
                <div class="grid">
                    <input class="wrap bg-bg2 p-2 text-sm" id="password_confirmation" name="password_confirmation" type="password">
                    @error('password-confirmation')
                    <span class="text-red-700 text-sm">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <button class="btn btn-submit mt-4" type="submit">Aanvragen</button>
    </form>
</div>
@endsection