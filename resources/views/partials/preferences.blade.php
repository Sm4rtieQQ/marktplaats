<div class="grid grid-cols gap-2">
    <h1 class="heading text-accent">Voorkeuren</h1>
    <div>
        <h2 class="font-semibold">Email</h2>
        <form action="{{ route('user.notifications', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <input
                class="peer hidden"
                type="checkbox"
                name="chat_email"
                id="chat_email"
                onchange="this.form.submit()"
                {{ $user->notifications ? 'checked' : 0  }}>
            <label
                class="text-xs wrap px-2 py-1 bg-bg1 w-fit select-none peer-checked:bg-bg3 peer-checked:text-white"
                for="chat_email">
                Nieuwe chatberichten
            </label>
        </form>
    </div>
</div>