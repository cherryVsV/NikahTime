<?php

namespace Database\Seeders;

use App\Models\MaritalStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*Model::unguard();

        $this->call(EducationSeeder::class);
        $this->call(MaritalStatusSeeder::class);
        $this->call(HabitSeeder::class);
        Model::reguard();*/
        $this->call(ProfileTableSeeder::class);
    }
}
