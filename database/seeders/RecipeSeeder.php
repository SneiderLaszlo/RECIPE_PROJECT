<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::where('email', 'user@example.com')->first();

        $recipes = [
            [
                'name'        => 'Rakott krumpli',
                'description' => 'Klasszikus magyar egytálétel kolbásszal, tojással és tejföllel.',
                'prep_time'   => 90,
                'difficulty'  => 'közepes',
                'servings'    => 4,
                'status'      => 'approved',
                'categories'  => ['Főétel'],
                'ingredients' => [
                    ['burgonya', 1, 'kg'],
                    ['tojás', 6, 'db'],
                    ['kolbász', 30, 'dkg'],
                    ['tejföl', 4, 'dl'],
                    ['vaj', 2, 'ek'],
                    ['só', 1, 'tk'],
                ],
                'steps' => [
                    'A burgonyát héjában puhára főzzük, majd meghámozzuk és karikára vágjuk.',
                    'A tojásokat keményre főzzük, megpucoljuk és felszeleteljük.',
                    'A kolbászt vékony karikákra vágjuk.',
                    'A kivajazott tűzálló tálba rétegezzük a burgonyát, tojást és kolbászt, a rétegeket sózzuk és tejföllel megkenjük.',
                    'A tetejére tejföl kerül, 200 fokon 30 percig sütjük, amíg aranybarna nem lesz.',
                ],
            ],
            [
                'name'        => 'Palacsinta',
                'description' => 'Vékony, könnyű palacsinta, tölthető lekvárral, túróval vagy csokival.',
                'prep_time'   => 30,
                'difficulty'  => 'könnyű',
                'servings'    => 4,
                'status'      => 'approved',
                'categories'  => ['Desszert', 'Gyors', 'Vegetáriánus'],
                'ingredients' => [
                    ['liszt', 25, 'dkg'],
                    ['tej', 5, 'dl'],
                    ['tojás', 2, 'db'],
                    ['étolaj', 2, 'ek'],
                    ['só', 1, 'csipet'],
                    ['porcukor', 2, 'ek'],
                ],
                'steps' => [
                    'A lisztet, a tojásokat, a tejet, a sót és az olaj felét csomómentesre keverjük.',
                    'A tésztát 10 percig pihentetjük.',
                    'Egy forró, kiolajozott serpenyőben mindkét oldalukon aranybarnára sütjük a palacsintákat.',
                    'Tetszés szerint megtöltjük, és porcukorral megszórva tálaljuk.',
                ],
            ],
            [
                'name'        => 'Gulyásleves',
                'description' => 'Tradicionális, sűrű, fűszeres marhahúsleves burgonyával.',
                'prep_time'   => 120,
                'difficulty'  => 'közepes',
                'servings'    => 6,
                'status'      => 'approved',
                'categories'  => ['Leves', 'Főétel'],
                'ingredients' => [
                    ['marhahús', 60, 'dkg'],
                    ['burgonya', 50, 'dkg'],
                    ['vöröshagyma', 2, 'db'],
                    ['sárgarépa', 2, 'db'],
                    ['paprika', 1, 'db'],
                    ['paradicsom', 1, 'db'],
                    ['pirospaprika', 2, 'ek'],
                    ['fokhagyma', 2, 'db'],
                    ['kömény', 1, 'tk'],
                    ['étolaj', 3, 'ek'],
                    ['só', 2, 'tk'],
                ],
                'steps' => [
                    'A felaprított hagymát olajon üvegesre pirítjuk, majd levesszük a tűzről, és belekeverjük a pirospaprikát.',
                    'Hozzáadjuk a kockákra vágott marhahúst, sózzuk, és fedő alatt a saját levében puhulásig pároljuk.',
                    'Beletesszük a felkarikázott répát, a paprikát, a paradicsomot, a zúzott fokhagymát és a köményt.',
                    'Felöntjük vízzel, és kb. 1 órán át főzzük.',
                    'Hozzáadjuk a kockázott burgonyát, és további 20-25 percig főzzük, amíg minden megpuhul.',
                ],
            ],
            [
                'name'        => 'Spagetti carbonara',
                'description' => 'Gyors olasz tészta baconnel, tojással és parmezánnal, tejszín nélkül.',
                'prep_time'   => 25,
                'difficulty'  => 'közepes',
                'servings'    => 4,
                'status'      => 'approved',
                'categories'  => ['Főétel', 'Gyors'],
                'ingredients' => [
                    ['tészta', 40, 'dkg'],
                    ['bacon', 20, 'dkg'],
                    ['tojás', 3, 'db'],
                    ['parmezán', 10, 'dkg'],
                    ['bors', 1, 'tk'],
                    ['só', 1, 'tk'],
                ],
                'steps' => [
                    'A tésztát sós vízben kifőzzük, és egy bögrényi főzővizet félreteszünk.',
                    'A baconkockákat száraz serpenyőben ropogósra sütjük.',
                    'A tojásokat a lereszelt parmezánnal és a borssal habosra keverjük.',
                    'A lecsepegtetett tésztát a baconhoz keverjük, a tűzről levéve hozzáadjuk a tojásos keveréket, és egy kevés főzővízzel krémesre forgatjuk.',
                ],
            ],
            [
                'name'        => 'Gyümölcssaláta',
                'description' => 'Friss, mézes gyümölcssaláta, gyors és egészséges desszert.',
                'prep_time'   => 15,
                'difficulty'  => 'könnyű',
                'servings'    => 4,
                'status'      => 'pending', // moderáció tesztelésére
                'categories'  => ['Desszert', 'Saláta', 'Vegetáriánus', 'Gluténmentes', 'Gyors'],
                'ingredients' => [
                    ['alma', 2, 'db'],
                    ['banán', 2, 'db'],
                    ['narancs', 2, 'db'],
                    ['eper', 20, 'dkg'],
                    ['citrom', 1, 'db'],
                    ['méz', 2, 'ek'],
                ],
                'steps' => [
                    'A gyümölcsöket megmossuk, megpucoljuk és kisebb darabokra vágjuk.',
                    'A citrom levét a mézzel összekeverjük, és ezzel öntjük le a gyümölcsöket.',
                    'Óvatosan átforgatjuk, majd tálalás előtt 10 percre hűtőbe tesszük.',
                ],
            ],
        ];

        foreach ($recipes as $data) {
            $recipe = Recipe::create([
                'name'        => $data['name'],
                'description' => $data['description'],
                'prep_time'   => $data['prep_time'],
                'difficulty'  => $data['difficulty'],
                'servings'    => $data['servings'],
                'author_id'   => $author->id,
                'status'      => $data['status'],
            ]);

            // Kategóriák
            $recipe->categories()->attach(
                Category::whereIn('name', $data['categories'])->pluck('id')
            );

            // Hozzávalók mennyiséggel és mértékegységgel
            foreach ($data['ingredients'] as [$name, $amount, $unit]) {
                $recipe->ingredients()->attach(
                    Ingredient::firstOrCreate(['name' => $name])->id,
                    [
                        'amount'  => $amount,
                        'unit_id' => Unit::firstOrCreate(['abbreviation' => $unit])->id,
                    ]
                );
            }

            // Lépések
            foreach ($data['steps'] as $index => $text) {
                $recipe->steps()->create([
                    'step_number' => $index + 1,
                    'description' => $text,
                ]);
            }
        }
    }
}