<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Education;
use App\Models\Habit;
use App\Models\MaritalStatus;
use App\Models\Profile;
use App\Models\User;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 35,
            'first_name' => $this->faker->firstNameFemale,
            'last_name' => $this->faker->lastName,
            'gender' => 'female',
            'birth_date' => $this->faker->date(),
            'country' => 'Россия',
            'city' => 'Тверь',
            'education_id' => 4,
            'place_of_study' => $this->faker->text(255),
            'place_of_work' => $this->faker->text(255),
            'work_position' => $this->faker->text(255),
            'marital_status_id' => 1,
            'have_children' => $this->faker->boolean,
            'about' => $this->faker->text,
        ];
    }
}
