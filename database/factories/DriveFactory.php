<?php

namespace Database\Factories;

use App\Models\Drive;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Drive::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name"        => $this->faker->name(),
            "description" => "I'a driver",
            "level"       => 10,
            "license"     => "PRO-AM",
            "points"      => 23,
        ];
    }
}
