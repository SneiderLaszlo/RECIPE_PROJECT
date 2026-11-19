@extends('layouts.site')

@section('title', 'Kedvencek')

@section('content')

    <div class="page-header">
        <h1 class="page-title">❤️ Kedvenc receptjeim</h1>
    </div>

    @if ($recipes->isEmpty())
        <p class="empty">Még nincs kedvenc recepted. Kattints a 🤍 szívre egy recepten!</p>
    @else
        <div class="recipe-grid">
            @foreach ($recipes as $recipe)
                @include('partials.recipe-card', ['recipe' => $recipe, 'isFavorite' => true])
            @endforeach
        </div>

        {{ $recipes->links('pagination::bootstrap-4') }}
    @endif

@endsection