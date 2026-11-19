{{-- Egy receptkártya. Kell hozzá: $recipe és $isFavorite (true/false) --}}
<div class="recipe-card-wrap">

    <a href="{{ route('recipes.show', $recipe) }}" class="recipe-card">

        <h3>{{ $recipe->name }}</h3>

        <p class="description">{{ Str::limit($recipe->description, 100) }}</p>

        <div class="badges">
            @foreach ($recipe->categories as $category)
                <span class="badge">{{ $category->name }}</span>
            @endforeach
        </div>

        <div class="meta">
            {{ $recipe->prep_time }} perc ·
            {{ $recipe->difficulty }} ·
            {{ $recipe->servings }} adag
        </div>

        <div class="author">Feltöltötte: {{ $recipe->author->name }}</div>
    </a>

    {{-- A szív a kártyán kívül van, mert gomb nem lehet link (<a>) belsejében --}}
    @include('partials.favorite-button', ['recipe' => $recipe, 'active' => $isFavorite])

</div>