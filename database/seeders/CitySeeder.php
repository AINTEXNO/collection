<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::insert([
           ['title' => 'Сергиев Посад'],
           ['title' => 'Москва'],
           ['title' => 'Хотьково'],
           ['title' => 'Пушкино'],
           ['title' => 'Королев'],
           ['title' => 'Красногорск'],
        ]);
    }
}
