<div class="border-l-1 border-accent pl-2 pb-4">

    <form class="grid gap-2" action="{{ route('listings.index') }}" method="GET">
        @csrf

        <h2 class="text-accent font-semibold">Zoeken:</h2>

        <h3 class="text-sm font-semibold">Trefwoord</h3>
        <input
            class="wrap bg-bg1 p-2"
            type="text"
            name="keyword"
            id="keyword"
            value="{{ old('keyword', $keyword) }}"
            maxlength="24">
        @error('keyword')
        <span class="text-red-700 text-xs">{{ $message }}</span>
        @enderror

        <h2 class="text-sm font-semibold">Categorie</h2>
        @if(isset($selectedCategory))
        <div class="mb-3">
            <p class="text-xs italic">Geselecteerde categorie:</p>
            <p class="wrap bg-bg1 p-2 text-xs font-semibold text-center">{{ $selectedCategory->name }}</p>
        </div>
        @endif

        <div class="flex flex-wrap gap-2">
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
        </div>

        <button class="btn btn-submit w-fit text-sm mt-4" type="submit">Filter toepassen</button>
        @if(isset($keyword) | isset($selectedCategory))
        <a class="font-semibold text-xs text-red-700" href="{{ route('listings.index') }}">Filters resetten</a>
        @endif
    </form>

</div>