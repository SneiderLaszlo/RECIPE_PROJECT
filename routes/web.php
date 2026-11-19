<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PantryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

// Főoldal: a három választási lehetőség
Route::view('/', 'home')->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Hűtő
    Route::get('/pantry', [PantryController::class, 'index'])->name('pantry.index');
    Route::post('/pantry', [PantryController::class, 'store'])->name('pantry.store');
    Route::delete('/pantry/{pantryItem}', [PantryController::class, 'destroy'])->name('pantry.destroy');

    // Kedvencek
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/recipes/{recipe}/favorite', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
});

// A random-nak a resource ELŐTT kell lennie, különben a {recipe} "random"-ot azonosítónak venné (404).
Route::get('/recipes/random', [RecipeController::class, 'random'])->name('recipes.random');

Route::resource('recipes', RecipeController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';