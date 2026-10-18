<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable=[
        'abbrevation',
    ];
    public function pantryItems()
    {
        return $this->hasMany(PantryItem::class);
    }
}
