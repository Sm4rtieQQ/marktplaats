<div class="navbar bg-bg2 flex z-50">
    <span class="title text-accent mr-8">Marktplaats</span>
    <nav class="flex flex-auto">
        <a class="heading text-xl text-accent px-4 py-1 rounded-md hover:bg-bg1" href="{{ route('listings.index') }}">Overzicht</a>
        <a class="heading text-xl text-accent px-4 py-1 rounded-md hover:bg-bg1" href="{{ route('listings.create') }}">Nieuwe aanbieding</a>
        <a class="heading text-xl text-accent px-4 py-1 rounded-md hover:bg-bg1 absolute right-4" href="{{ route('user.login') }}">Login</a>
    </nav>
</div>