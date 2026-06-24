<form class="wrap bg-bg1 text-text1 grid p-4 gap-4" action="{{ $newListing ? route('listing.store') : route('listing.update', $listing) }}" method="POST">
    @csrf
    @if(!$newListing)
    @method('PUT')
    @endif

    <label class="font-semibold" for="name">Te koop:</label>
    <div class="grid gap-2">
        <input class="wrap bg-bg2 p-2" name="name" id="name" type="text" placeholder="titel" value="{{ old('name', $listing->name) }}" />
        @error('name')
        <span class="text-red-700 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <label class="font-semibold" for="description">Omschrijving:</label>
    <div class="grid gap-2">
        <textarea class="wrap bg-bg2 p-2 h-64" name="description" id="description" placeholder="omschrijving">{{ old('description', $listing->description) }}</textarea>
        @error('description')
        <span class="text-red-700 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="grid grid-cols-2 gap-6">

        <div class="grid grid-cols-[120px_auto]">
            <label class="font-semibold" for="price">Vraagprijs:</label>
            <div class="grid">
                <div>
                    <span class="price self-center">€</span>
                    <input
                        class="wrap price bg-bg2 p-2 w-28"
                        name="price"
                        id="price"
                        type="number"
                        step="0.01"
                        value="{{ number_format(old('price', $listing->price ?? 0), 2, '.', '') }}"
                        onblur="this.value = parseFloat(this.value || 0).toFixed(2)" />
                </div>
                @error('price')
                <span class="text-red-700 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-[120px_auto]">
            <label class="font-semibold">Categoriën:</label>
            <div class="flex flex-wrap">
                @foreach($categories as $category)
                <div class="m-1">
                    <input class="peer hidden" type="checkbox" name="categories[]" id="box-{{$category->id}}" value="{{$category->id}}" {{ in_array($category->id, $selectedCategories ?? []) ? 'checked' : '' }} />
                    <label for="box-{{$category->id}}" class="wrap px-2 py-1 cursor-pointer select-none bg-bg2 peer-checked:bg-bg3 peer-checked:text-white">{{$category->name}} </label>
                </div>
                @endforeach
            </div>
        </div>

    </div>
    <div class="flex gap-2 mt-4">
        <button class="btn btn-submit" type="submit">Plaatsen!</button>
        <a class="btn btn-cancel" href="{{ $newListing ? route('listings.index') : route('listing.show', $listing) }}">Annuleren</a>
    </div>
</form>