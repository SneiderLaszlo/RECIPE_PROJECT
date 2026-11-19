<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Receptek') – Recept oldal</title>

    {{-- Barátságos betűtípusok (internet nélkül a tartalék betűk jelennek meg) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    {{-- A saját CSS betöltése. A ?v=... rész azért kell, hogy módosítás után a böngésző az újat töltse be. --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}">
</head>
<body>

    <header class="site-header">
        <div class="container">

            <a href="{{ route('home') }}" class="brand">🍲 Recept oldal</a>

            <nav class="nav">

                {{-- Bejelentkezett felhasználónak: Profil legördülő menü (a menüsor első eleme) --}}
                @auth
                    <div class="dropdown">
                        <button type="button"
                                class="nav-link nav-button dropdown-toggle {{ request()->routeIs('profile.*', 'pantry.*', 'favorites.*') ? 'active' : '' }}">
                            👤 Profil ▾
                        </button>

                        <div class="dropdown-menu">
                            <span class="dropdown-header">{{ Auth::user()->name }}</span>

                            <a href="{{ route('profile.edit') }}" class="dropdown-item">⚙️ Profil módosítása</a>
                            <a href="{{ route('pantry.index') }}" class="dropdown-item">🧊 Hűtőm</a>
                            <a href="{{ route('favorites.index') }}" class="dropdown-item">❤️ Kedvencek</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">🚪 Kijelentkezés</button>
                            </form>
                        </div>
                    </div>
                @endauth

                <a href="{{ route('home') }}"
                    class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    Főoldal
                </a>

                {{-- Vendégnek (nincs bejelentkezve) --}}
                @guest
                    <a href="{{ route('login') }}" class="nav-link">Bejelentkezés</a>
                    <a href="{{ route('register') }}" class="nav-link">Regisztráció</a>
                @endguest
            </nav>

        </div>
    </header>

    <main class="container">
        @if (session('status'))
            <div class="alert">{{ session('status') }}</div>
        @endif

        @yield('content')
    </main>

    <footer class="site-footer">
    Jó étvágyat! 🍽️ · Recept oldal
    </footer>

</body>
</html>