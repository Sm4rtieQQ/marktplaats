<div class="border-l-1 border-accent pl-2 pb-4">
    <h2 class="text-accent font-semibold mb-4">Selecteer categorie:</h2>

    <div class="mb-6">
        @if(isset($selectedCategory))
        <p class="text-xs font-semibold">Alle artikelen met:</p>
        <p class="wrap bg-bg1 p-2 text-xs font-semibold text-center">{{ $selectedCategory->name }}</p>
        <a class="text-red-700 text-xs font-semibold cursor-pointer" href="{{ route('listings.index') }}">Filter verwijderen</a>
        @endif
    </div>

    <form class="grid gap-3" action="{{ route('listings.index') }}" method="GET">
        @csrf
        @foreach($categories as $category)
        <div>
            <input
                class="peer hidden"
                type="radio"
                name="category"
                id="{{ $category->id }}"
                value="{{ $category->id }}"
                {{ $selectedCategory?->id == $category->id ? 'checked' : ''}}>
            <label
                class="wrap px-2 py-1 bg-bg1 w-fit select-none peer-checked:bg-bg3 peer-checked:text-white"
                for="{{ $category->id }}">
                {{ $category->name }}
            </label>
        </div>
        @endforeach

        <button class="btn btn-submit w-fit" type="submit">Filter toepassen</button>
    </form>
</div>