<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
           ['title' => 'Бижутерия'],
           ['title' => 'Аксессуары для волос'],
           ['title' => 'Солнцезащитные очки'],
           ['title' => 'Сумки'],
           ['title' => 'Кошельки'],
           ['title' => 'Рюкзаки'],
        ]);
    }
}
