@extends('layouts.site')

@section('title', 'Receptek')

@section('content')

    <div class="page-header">
        <h1 class="page-title">Receptek</h1>
    </div>
    <form method="GET" action="{{ route('recipes.index') }}" class="search-form">

    <select name="category" onchange="this.form.submit()">
        <option value="">Minden kategória</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <input type="text" name="needle" value="{{ request('needle') }}"
           placeholder="Keresés a receptek között...">

    <button type="submit" class="btn">Keresés</button>

    @if (request()->filled('needle') || request()->filled('category'))
        <a href="{{ route('recipes.index') }}" class="btn btn-light">Törlés</a>
    @endif

</form>

    @if ($recipes->isEmpty())
        <p class="empty">Nincs találat.</p>
    @else
        <div class="recipe-grid">
            @foreach ($recipes as $recipe)
                <a href="{{ route('recipes.show', $recipe) }}" class="recipe-card">

                    <h3>{{ $recipe->name }}</h3>

                    <p class="description">{{ Str::limit($recipe->description, 100) }}</p>

                    <div class="badges">
                        @foreach ($recipe->categories as $category)
                            <span class="badge">{{ $category->name }}</span>
                        @endforeach
                    </div>

                    <div class="meta">
                        {{ $recipe->prep_time }} perc |
                        {{ $recipe->difficulty }} |
                        {{ $recipe->servings }} adag
                    </div>

                    <div class="author">Feltöltötte: {{ $recipe->author->name }}</div>
                </a>
            @endforeach
        </div>

        {{-- Lapozó --}}
        {{ $recipes->links('pagination::bootstrap-4') }}
    @endif

@endsection