<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecipeController extends Controller
{
    /**
     * A jóváhagyott receptek listája, névre kereséssel.
     */
    public function index(Request $request): View
    {
        $query = Recipe::with(['categories', 'author'])
            ->where('status', 'approved');

        if ($request->filled('needle')) {
            $query->where('name', 'like', '%' . $request->needle . '%');
        }

        $recipes = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // Melyik receptek vannak a kedvencek között (vendégnek üres lista)
        $favoriteIds = $request->user()?->favoriteRecipes()->pluck('recipes.id')->all() ?? [];

        return view('recipes.index', compact('recipes', 'favoriteIds'));
    }

    /**
     * Egy recept részletes oldala.
     */
    public function show(Request $request, Recipe $recipe): View
    {
        // Csak jóváhagyott recept látható (a moderációra váró nem).
        abort_unless($recipe->status === 'approved', 404);

        $recipe->load([
            'categories',
            'author',
            'ingredients',
            'steps' => fn ($query) => $query->orderBy('step_number'),
        ]);

        // mértékegység id => rövidítés (a hozzávalók mellé kiírva)
        $units = Unit::pluck('abbreviation', 'id');

        // Kedvenc-e ez a recept a belépett felhasználónak?
        $isFavorite = $request->user()
            ?->favoriteRecipes()
            ->where('recipes.id', $recipe->id)
            ->exists() ?? false;

        return view('recipes.show', compact('recipe', 'units', 'isFavorite'));
    }

    /**
     * Egy véletlenszerű, jóváhagyott receptre irányít.
     */
    public function random(): RedirectResponse
    {
        $recipe = Recipe::where('status', 'approved')->inRandomOrder()->first();

        if (! $recipe) {
            return redirect()->route('recipes.index')
                ->with('status', 'Még nincs jóváhagyott recept.');
        }

        return redirect()->route('recipes.show', $recipe);
    }
}