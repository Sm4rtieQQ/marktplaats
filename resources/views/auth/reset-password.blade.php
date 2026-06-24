@extends('layouts.app')

@section('title', 'Wachtwoord vergeten')

@section('content')
<div class="w-[500px] mx-auto grid gap-2">

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <h1 class="heading text-accent">Nieuw wachtwoord aanvragen</h1>
        @if(session('success'))
        <span class="text-green-600 text-sm">{{ $message }}</span>
        @endif
        <div class="wrap bg-bg1 p-4">
            <div class="grid grid-cols-[120px_auto] gap-y-4">

                <label class="font-semibold self-center" for="email">Email</label>
                <div class="grid">
                    <input class="wrap bg-bg2 p-2 text-sm" id="email" name="email" value="{{ old('email')}}">
                    @error('email')
                    <span class="text-red-700 text-sm">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <button class="btn btn-submit mt-4" type="submit">Aanvragen</button>
    </form>
</div>
@endsection