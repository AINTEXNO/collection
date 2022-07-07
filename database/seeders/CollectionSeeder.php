<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collection::insert([
            ['title' => 'Геометрия золота'],
            ['title' => 'Звездная ночь'],
            ['title' => 'Жемчужина мечты'],
            ['title' => 'COLOR TWIST'],
            ['title' => 'Оттенки нежности'],
            ['title' => 'Малибу'],
            ['title' => 'Love story'],
            ['title' => 'Follow me'],
            ['title' => 'РУБИНА'],
            ['title' => 'Глинтвейн'],
            ['title' => 'Verde'],
            ['title' => 'Rock & Pop'],
        ]);
    }
}
