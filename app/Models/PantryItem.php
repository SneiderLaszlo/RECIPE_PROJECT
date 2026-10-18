<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PantryItem extends Model
{
    protected $fillable=[
        'user_id',
        'ingredient_id',
        'amount',
        'unit_id',
        'expiry_date'
    ];
    protected $casts = [
        'expiry_date' => 'date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
