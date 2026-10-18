<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $ingredients = [
            // Zöldségek
            'burgonya', 'vöröshagyma', 'lilahagyma', 'fokhagyma', 'sárgarépa',
            'petrezselyemgyökér', 'zeller', 'paradicsom', 'paprika', 'csípős paprika',
            'uborka', 'cukkini', 'padlizsán', 'brokkoli', 'karfiol',
            'káposzta', 'spenót', 'saláta', 'gomba', 'kukorica',
            'zöldborsó', 'zöldbab', 'póréhagyma', 'cékla', 'sütőtök',
 
            // Gyümölcsök
            'citrom', 'alma', 'banán', 'narancs', 'eper',
            'málna', 'áfonya', 'szilva', 'meggy', 'körte',
 
            // Tejtermékek és tojás
            'tej', 'vaj', 'tejföl', 'tejszín', 'joghurt',
            'túró', 'trappista sajt', 'mozzarella', 'parmezán', 'feta sajt',
            'tojás',
 
            // Húsok, halak, felvágottak
            'csirkemell', 'csirkecomb', 'sertéskaraj', 'sertéscomb', 'darált hús',
            'marhahús', 'bacon', 'kolbász', 'sonka', 'szalonna',
            'lazac', 'tonhal',
 
            // Alapanyagok, száraz áruk
            'liszt', 'cukor', 'vaníliás cukor', 'porcukor', 'só',
            'étolaj', 'olívaolaj', 'rizs', 'tészta', 'kenyér',
            'zsemlemorzsa', 'élesztő', 'sütőpor', 'zabpehely', 'lencse',
            'kakaó', 'étcsokoládé', 'méz', 'ecet',
 
            // Fűszerek, ízesítők
            'bors', 'pirospaprika', 'kömény', 'majoranna', 'oregánó',
            'bazsalikom', 'petrezselyemzöld', 'kapor', 'rozmaring', 'kakukkfű',
            'babérlevél', 'fahéj', 'szerecsendió', 'gyömbér', 'curry',
 
            // Szószok, készítmények
            'mustár', 'ketchup', 'szójaszósz', 'paradicsompüré', 'paradicsomszósz',
 
            // Magvak
            'dió', 'mandula', 'mogyoró',
        ];
 
        foreach ($ingredients as $name) {
            Ingredient::firstOrCreate(['name' => $name]);
        }
    }
}
