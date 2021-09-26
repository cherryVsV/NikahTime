<?php

namespace Database\Seeders;

use App\Models\Habit;
use Illuminate\Database\Seeder;

class HabitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $habits = [
            ['title'=>'smoking'],
            ['title'=>'alcohol'],
            ['title'=>'gambling'],
            ['title'=>'other']
        ];
        foreach ($habits as $habit)
            Habit::create([
                'title' => $habit['title']
            ]);
    }
}
