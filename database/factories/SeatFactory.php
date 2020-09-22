<?php

namespace Database\Factories;

use App\Models\Bus;
use App\Models\Seat;
use Database\Seeders\BusSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SeatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seat::class;

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
            'status' => $this->faker->boolean(true)
        ];
    }
}
