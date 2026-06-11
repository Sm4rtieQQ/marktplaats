<form class="wrap bg-bg1 text-text1 grid p-4 gap-4" action="{{route('listings.store')}}" method="POST">
    @csrf
    <label class="font-semibold" for="name">Te koop:</label>
    <input class="wrap bg-bg2 p-2" name="name" id="name" type="text" placeholder="titel" />

    <label class="font-semibold" for="description">Omschrijving:</label>
    <textarea class="wrap bg-bg2 p-2 h-64" name="description" id="description" placeholder="omschrijving"></textarea>

    <div class="grid grid-cols-[120px_120px]">
        <label class="font-semibold self-center" for="price">Vraagprijs:</label>
        <div class="flex gap-2">
            <span class="price self-center">€</span>
            <input
                class="wrap price bg-bg2 p-2"
                name="price"
                id="price"
                type="number"
                step="hidden"
                value="{{ number_format(old('price', $price ?? 0), 2, '.', '') }}"
                onblur="this.value = parseFloat(this.value || 0).toFixed(2)" />
        </div>

        <div class="flex gap-2 mt-4">
            <button class="btn btn-submit" type="submit">Plaatsen!</button>
            <a class="btn btn-cancel" href="{{route('listings.index')}}">Annuleren</a>
        </div>
</form>