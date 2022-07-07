<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::insert([
           ['title' => 'Белый'],
           ['title' => 'Бронзовый'],
           ['title' => 'Голубой'],
           ['title' => 'Зеленый'],
           ['title' => 'Золотой'],
           ['title' => 'Карамельный'],
           ['title' => 'Коричневый'],
           ['title' => 'Красный'],
           ['title' => 'Кристалл'],
           ['title' => 'Мультицвет'],
           ['title' => 'Оранжевый'],
           ['title' => 'Принт'],
           ['title' => 'Розовый'],
           ['title' => 'Серебряный'],
           ['title' => 'Серый'],
           ['title' => 'Синий'],
           ['title' => 'Сиреневый'],
           ['title' => 'Черный'],
        ]);
    }
}
