<?php

namespace Database\Factories;

use App\Models\Price;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Price::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
//            'bus_id' => 1,
//            'bus_id' => 2,
            'bus_id' => 3,
            'city_id'=> $this->faker->numberBetween(1,9),
            'price' => $this->faker->numberBetween(10,40)
        ];
    }
}
