<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::insert([
           ['title' => 'Les Nereides'],
           ['title' => 'Dyrberg/Kern'],
           ['title' => 'Coeur de Lion'],
           ['title' => 'Clara Bijoux'],
           ['title' => 'Amaro'],
           ['title' => 'Nature Bijoux'],
           ['title' => 'Majorica'],
           ['title' => 'ARMADURA URBANA'],
        ]);
    }
}
