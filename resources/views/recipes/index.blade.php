@extends('layouts.site')

@section('title', 'Receptek')

@section('content')

    <div class="page-header">
        <h1 class="page-title">Receptek</h1>
    </div>

    {{-- Kereső --}}
    <form method="GET" action="{{ route('recipes.index') }}" class="search-form">
        <input type="text" name="needle" value="{{ request('needle') }}"
               placeholder="Keresés a receptek között...">
        <button type="submit" class="btn">Keresés</button>

        @if (request()->filled('needle'))
            <a href="{{ route('recipes.index') }}" class="btn btn-light">Törlés</a>
        @endif
    </form>

    @if ($recipes->isEmpty())
        <p class="empty">Nincs találat.</p>
    @else
        <div class="recipe-grid">
            @foreach ($recipes as $recipe)
                @include('partials.recipe-card', [
                    'recipe' => $recipe,
                    'isFavorite' => in_array($recipe->id, $favoriteIds),
                ])
            @endforeach
        </div>

        {{-- Lapozó --}}
        {{ $recipes->links('pagination::bootstrap-4') }}
    @endif

@endsection