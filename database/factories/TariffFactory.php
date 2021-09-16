<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Tariff;

class TariffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tariff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->text,
            'one_month_price' => $this->faker->numberBetween(-10000, 10000),
            'three_month_price' => $this->faker->numberBetween(-10000, 10000),
            'year_price' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
