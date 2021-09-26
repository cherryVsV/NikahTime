<?php

namespace Database\Seeders;

use App\Models\MaritalStatus;
use Illuminate\Database\Seeder;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['title'=>'notMarried'],
            ['title'=>'married'],
            ['title'=>'divorced']
        ];
        foreach ($statuses as $status)
            MaritalStatus::create([
                'title' => $status['title']
            ]);
    }
}
