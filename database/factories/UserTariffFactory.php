<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Tariff;
use App\Models\User;
use App\Models\UserTariff;

class UserTariffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserTariff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'tariff_id' => Tariff::factory(),
            'period' => $this->faker->numberBetween(-10000, 10000),
            'payment_amount' => $this->faker->numberBetween(-10000, 10000),
            'finished_at' => $this->faker->dateTime(),
        ];
    }
}
