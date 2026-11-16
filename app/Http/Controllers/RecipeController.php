<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Unit;
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

        return view('recipes.index', compact('recipes'));
    }

    /**
     * Egy recept részletes oldala.
     */
    public function show(Recipe $recipe): View
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

        return view('recipes.show', compact('recipe', 'units'));
    }
}