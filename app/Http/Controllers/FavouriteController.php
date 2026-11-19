<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    /**
     * A bejelentkezett felhasználó kedvenc receptjei.
     */
    public function index(Request $request): View
    {
        $recipes = $request->user()->favoriteRecipes()
            ->where('recipes.status', 'approved')
            ->with(['categories', 'author'])
            ->orderByPivot('created_at', 'desc')   // legutóbb mentett elöl
            ->paginate(12);

        return view('favorites.index', compact('recipes'));
    }

    /**
     * Szívre kattintás: ha kedvenc, kiveszi, ha nem, beteszi.
     */
    public function toggle(Request $request, Recipe $recipe): RedirectResponse
    {
        abort_unless($recipe->status === 'approved', 404);

        $request->user()->favoriteRecipes()->toggle($recipe->id);

        return back();
    }
}