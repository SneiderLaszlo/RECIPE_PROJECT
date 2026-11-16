@extends('layouts.site')

@section('title', $recipe->name)

@section('content')

    <div class="container-narrow" style="margin: 0 auto;">
        <div class="card">

            <h1 class="page-title">{{ $recipe->name }}</h1>

            <div class="badges">
                @foreach ($recipe->categories as $category)
                    <span class="badge">{{ $category->name }}</span>
                @endforeach
            </div>

            <p>{{ $recipe->description }}</p>

            <div class="meta">
                {{ $recipe->prep_time }} perc ·
                {{ $recipe->difficulty }} ·
                {{ $recipe->servings }} adag ·
                Feltöltötte: {{ $recipe->author->name }}
            </div>

            <h2 class="section-title">Hozzávalók</h2>
            <ul class="ingredient-list">
                @foreach ($recipe->ingredients as $ingredient)
                    <li>
                        {{ (float) $ingredient->pivot->amount }}
                        {{ $units[$ingredient->pivot->unit_id] ?? '' }}
                        {{ $ingredient->name }}
                    </li>
                @endforeach
            </ul>

            <h2 class="section-title">Elkészítés</h2>
            <ol class="steps">
                @foreach ($recipe->steps as $step)
                    <li>
                        <span class="step-number">{{ $step->step_number }}</span>
                        <span>{{ $step->description }}</span>
                    </li>
                @endforeach
            </ol>

            <a href="{{ route('recipes.index') }}" class="back-link">← Vissza a receptekhez</a>

        </div>
    </div>

@endsection