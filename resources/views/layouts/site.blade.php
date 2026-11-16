<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Receptek') – Recept oldal</title>

    {{-- A saját CSS betöltése. A ?v=... rész azért kell, hogy módosítás után a böngésző az újat töltse be. --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}">
</head>
<body>

    <header class="site-header">
        <div class="container">

            <a href="{{ route('recipes.index') }}" class="brand">🍲 Recept oldal</a>

            <nav class="nav">
                <a href="{{ route('recipes.index') }}"
                   class="nav-link {{ request()->routeIs('recipes.*') ? 'active' : '' }}">
                    Receptek
                </a>

                {{-- Bejelentkezett felhasználónak --}}
                @auth
                    <span class="nav-user">{{ Auth::user()->name }}</span>

                    <a href="{{ route('profile.edit') }}" class="nav-link">Profil</a>

                    <form method="POST" action="{{ route('logout') }}" class="nav-form">
                        @csrf
                        <button type="submit" class="nav-link nav-button">Kijelentkezés</button>
                    </form>
                @endauth

                {{-- Vendégnek (nincs bejelentkezve) --}}
                @guest
                    <a href="{{ route('login') }}" class="nav-link">Bejelentkezés</a>
                    <a href="{{ route('register') }}" class="nav-link">Regisztráció</a>
                @endguest
            </nav>

        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer class="site-footer">
        Recept oldal
    </footer>

</body>
</html>
