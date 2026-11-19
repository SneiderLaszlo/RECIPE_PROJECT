{{-- Szív gomb. Kell hozzá: $recipe és $active (true/false) --}}
@auth
    <form method="POST" action="{{ route('favorites.toggle', $recipe) }}" class="heart-form">
        @csrf
        <button type="submit" class="heart"
                title="{{ $active ? 'Eltávolítás a kedvencek közül' : 'Mentés a kedvencekhez' }}">
            {{ $active ? '❤️' : '🤍' }}
        </button>
    </form>
@else
    <a href="{{ route('login') }}" class="heart heart-link" title="Jelentkezz be a kedvencekhez">🤍</a>
@endauth