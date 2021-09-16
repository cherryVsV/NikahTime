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
            'user_id' => User::factory(),
            'avatar' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'name' => $this->faker->name,
            'surname' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'gender' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'birthdate' => $this->faker->date(),
            'country' => $this->faker->country,
            'town' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'education_id' => Education::factory(),
            'place_of_study' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'place_of_work' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'post' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'marital_status_id' => MaritalStatus::factory(),
            'children' => $this->faker->boolean,
            'habit_id' => Habit::factory(),
            'about_me' => $this->faker->text,
        ];
    }
}
