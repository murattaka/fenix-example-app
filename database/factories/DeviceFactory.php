<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid,
            'user_id' => User::all()->random()->id,
            'name' => $this->faker->name . ' Device',
            'user_agent' => $this->faker->userAgent,
            'platform' => $this->faker->randomElement(['Windows', 'Mac', 'Linux', 'iOS', 'Android']),
        ];
    }
}
