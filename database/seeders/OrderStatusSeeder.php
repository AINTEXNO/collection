<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::insert([
           ['title' => 'Создан'],
           ['title' => 'Передан в доставку'],
           ['title' => 'Завершен'],
           ['title' => 'Отменен'],
        ]);
    }
}
