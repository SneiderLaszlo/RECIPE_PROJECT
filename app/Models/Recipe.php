<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable=[
        'name',
        'description',
        'prep_time',
        'difficulty',
        'servings',
        'author_id',
        'status'
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function steps()
    {
        return $this->hasMany(RecipeStep::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_recipe')
            ->withPivot('amount', 'unit_id')
            ->withTimestamps();
    }
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
}
