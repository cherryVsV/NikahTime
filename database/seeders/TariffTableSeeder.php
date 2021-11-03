<?php

namespace Database\Seeders;

use App\Models\Tariff;
use Illuminate\Database\Seeder;

class TariffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tariffs = [
            ['title'=>'Расширенные возможности приложения на 1 месяц - 289 руб.', 'description'=>'Расширенные возможности приложения на 1 месяц - 289 руб.', 'price'=>289, 'period'=>'+1 month'],
            ['title'=>'Расширенные возможности приложения на 3 месяца - 789 руб.', 'description'=>'Расширенные возможности приложения на 3 месяца - 789 руб.', 'price'=>789, 'period'=>'+3 month'],
            ['title'=>'Расширенные возможности приложения на 6 месяцев - 1489 руб.', 'description'=>'Расширенные возможности приложения на 6 месяцев - 1489 руб.', 'price'=>1489, 'period'=>'+6 month'],
            ['title'=>'Расширенные возможности приложения на 1 год - 2889 руб.', 'description'=>'Расширенные возможности приложения на 1 год - 2889 руб.', 'price'=>2889, 'period'=>'+1 year'],
            ['title'=>'VIP-тариф', 'description'=>'VIP-тариф', 'price'=>1989, 'period'=>'+1 month']
        ];
        foreach ($tariffs as $tariff)
            Tariff::create([
                'title' => $tariff['title'],
                'description' => $tariff['description'],
                'price' => $tariff['price'],
                'period' => $tariff['period'],
            ]);
    }
}
