<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $units = [
        'mg', 'g', 'dkg', 'kg', 't',
        'ml', 'cl', 'dl', 'l', 'hl',
        'db', 'tk', 'ek', 'csipet',
    ];

    foreach ($units as $abbreviation) {
        Unit::create(['abbreviation' => $abbreviation]);
    }
    }
}
