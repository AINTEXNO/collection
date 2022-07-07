<?php

namespace Database\Seeders;

use App\Models\Style;
use Illuminate\Database\Seeder;

class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Style::insert([
           ['title' => 'Casual'],
           ['title' => 'Беби Долл'],
           ['title' => 'Винтажный'],
           ['title' => 'Гламур'],
           ['title' => 'Классический'],
           ['title' => 'Клубный'],
           ['title' => 'Кэжуал'],
           ['title' => 'Молодежный'],
           ['title' => 'Рок'],
           ['title' => 'Романтический'],
           ['title' => 'Роскошный'],
           ['title' => 'Сафари'],
           ['title' => 'Хиппи'],
           ['title' => 'Школьный'],
           ['title' => 'Элегантный'],
           ['title' => 'Этнический'],
        ]);
    }
}
