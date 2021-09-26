<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $educations = [
            ['title'=>'basicGeneral'],
            ['title'=>'secondaryGeneral'],
            ['title'=>'secondaryVocational'],
            ['title'=>'higherBachelorOrSpecialist'],
            ['title'=>'higherMaster'],
            ['title'=>'academicDegree'],
        ];
        foreach ($educations as $education)
            Education::create([
                'title' => $education['title']
            ]);

    }
}
