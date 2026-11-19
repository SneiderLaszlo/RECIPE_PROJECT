<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\PantryItem;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PantryController extends Controller
{
    /**
     * A bejelentkezett felhasználó hűtőjének tartalma.
     */
    public function index(Request $request): View
    {
        $items = $request->user()->pantryItems()
            ->with(['ingredient', 'unit'])
            ->orderByRaw('expiry_date IS NULL')   // a dátum nélküliek a lista végére
            ->orderBy('expiry_date')              // legkorábban lejáró elöl
            ->get();

        $ingredients = Ingredient::orderBy('name')->get();
        $units = Unit::orderBy('id')->get();

        return view('pantry.index', compact('items', 'ingredients', 'units'));
    }

    /**
     * Új tétel a hűtőbe.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'ingredient_id' => ['required', 'exists:ingredients,id'],
            'amount'        => ['required', 'numeric', 'min:0.01', 'max:999999.99'],
            'unit_id'       => ['required', 'exists:units,id'],
            'expiry_date'   => ['nullable', 'date', 'after_or_equal:today'],
        ], [
            'ingredient_id.required'     => 'Válassz ki egy alapanyagot.',
            'amount.required'            => 'Add meg a mennyiséget.',
            'amount.numeric'             => 'A mennyiség szám legyen.',
            'amount.min'                 => 'A mennyiség legalább 0,01 legyen.',
            'unit_id.required'           => 'Válassz mértékegységet.',
            'expiry_date.after_or_equal' => 'A lejárati dátum nem lehet múltbeli.',
        ]);

        // A kapcsolaton keresztül hozzuk létre, így a user_id automatikusan a belépett felhasználóé lesz.
        $request->user()->pantryItems()->create($data);

        return redirect()->route('pantry.index')->with('status', 'Hozzáadva a hűtőhöz.');
    }

    /**
     * Tétel törlése (csak a sajátját törölheti).
     */
    public function destroy(Request $request, PantryItem $pantryItem): RedirectResponse
    {
        abort_unless($pantryItem->user_id === $request->user()->id, 403);

        $pantryItem->delete();

        return redirect()->route('pantry.index')->with('status', 'Eltávolítva a hűtőből.');
    }
}