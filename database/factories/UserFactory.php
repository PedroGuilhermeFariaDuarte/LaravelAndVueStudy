<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "username"    => $this->faker->realText($this->faker->numberBetween(10, 20)),
            "name"        => $this->faker->unique()->name(),
            "email"       => $this->faker->unique()->safeEmail(),
            "password"    => Str::random(10),
            "admin"       => true,
            "owner"       => true,
            "level_admin" => 1,
            "team_id"     => 0,
            "user_uuid"   => $this->faker->uuid(),
        ];
    }

}
