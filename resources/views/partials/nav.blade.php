<div class="navbar bg-bg2 flex z-50">
    <span class="title text-accent mr-8 select-none">Marktplaats</span>
    <nav class="flex flex-auto">
        <a class="heading text-xl text-accent px-4 py-1 rounded-md hover:bg-bg1" href="{{ route('listings.index') }}">Overzicht</a>

        @auth
        <a class="heading text-xl text-accent px-4 py-1 rounded-md hover:bg-bg1" href="{{ route('listing.create') }}">Nieuwe advertentie</a>
        <a class="heading text-xl text-accent px-4 py-1 rounded-md hover:bg-bg1" href="{{ route('user.dashboard') }}">Dashboard</a>
        <a class="heading text-xl text-accent px-4 py-1 rounded-md hover:bg-bg1" href="{{ route('chat.index') }}">Chats</a>
        @endauth

        @guest
        <a class="heading text-xl text-accent px-4 py-1 rounded-md hover:bg-bg1 ml-auto" href="{{ route('login') }}">Inloggen</a>
        @else
        <form action="{{route('user.logout')}}" class="ml-auto" method="POST">
            @csrf
            <button type="submit" class="heading text-xl text-accent px-4 py-1 rounded-md hover:bg-bg1 cursor-pointer">Uitloggen</button>
        </form>
        @endguest

    </nav>
</div>