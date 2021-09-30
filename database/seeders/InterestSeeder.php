<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $interests = [
            ['title'=>'Прогулки'],
            ['title'=>'Спорт'],
            ['title'=>'Кино'],
            ['title'=>'Йога'],
            ['title'=>'Еда'],
            ['title'=>'Туризм'],
            ['title'=>'Активный отдых'],
            ['title'=>'Бассейн'],
            ['title'=>'Кроссфит'],
            ['title'=>'Велосипед'],
            ['title'=>'Животные'],
            ['title'=>'Комедия'],
            ['title'=>'Любовь'],
        ];
        foreach ($interests as $interest)
            Interest::create([
                'title' => $interest['title']
            ]);
    }
}
