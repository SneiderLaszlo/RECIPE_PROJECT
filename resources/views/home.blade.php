@extends('layouts.site')

@section('title', 'Főoldal')

@section('content')

    <div class="page-header home-hero">
        <h1 class="page-title">Mit főzzünk ma?</h1>
        <p class="page-subtitle">Válaszd ki, hogyan találjuk meg a mai ebédet vagy vacsorát!</p>
    </div>

    <div class="home-buttons">

        {{-- 1. Saját keresés --}}
        <a href="{{ route('recipes.index') }}" class="home-card">
            <span class="home-icon">🔍</span>
            <h2>Keresek magam</h2>
            <p>Böngéssz a receptek között, szűrj név alapján.</p>
        </a>

        {{-- 2. Random --}}
        <a href="{{ route('recipes.random') }}" class="home-card">
            <span class="home-icon">🎲</span>
            <h2>Random</h2>
            <p>Dobjon ki egy ötletet a konyhatündér!</p>
        </a>

        {{-- 3. A hűtő tartalma alapján (egyelőre csak kinézet, működés később) --}}
        <div class="home-card home-card-disabled">
            <span class="home-icon">🧊</span>
            <h2>A hűtőm alapján</h2>
            <p>Abból főzünk, ami itthon van.</p>
            <span class="home-soon">Hamarosan</span>
        </div>

    </div>

@endsection