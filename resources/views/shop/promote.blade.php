@extends('layouts.app')

@section('title', 'Advertentie promoten')

@section('content')
<div class="w-[500px] mx-auto grid gap-2">

    <form action="{{ route('listing.promote', $listing) }}" method="POST">
        @csrf
        @method('PUT')
        <h1 class="heading text-accent">Advertentie promoten</h1>
        <div class="wrap bg-bg1 p-4">
            <p class="font-semibold">Promoot uw advertentie nu voor meer zichtbaarheid!</p>
            <table class="text-left w-full bg-white mt-4">
                <thead>
                    <tr>
                        <th class="p-2">Advertentie</th>
                        <th class="p-2">Prijs</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2">{{ $listing->name }}</td>
                        <td class="p-2 price text-sm">€10,00</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex gap-2 mt-4">
            <button class="btn btn-submit" type="submit">Advertentie promoten!</button>
            <a class="btn btn-cancel" href="{{ route('user.dashboard') }}">Annuleren</a>
        </div>
    </form>
</div>
@endsection