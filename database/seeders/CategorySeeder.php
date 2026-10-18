<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $categories = [
            'Reggeli',
            'Előétel',
            'Leves',
            'Főétel',
            'Köret',
            'Saláta',
            'Desszert',
            'Ital',
            'Vegetáriánus',
            'Gluténmentes',
            'Laktózmentes',
            'Halas',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
    
}
