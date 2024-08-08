<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->word;
        $id = Str::slug($name);

        while (Product::find($id) !== null) {
            $name = $this->faker->word;
        }

        return [
            'id' => $id,
            'name' => $name,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'description' => $this->faker->sentence,
            'daily_credit_limit' => $this->faker->numberBetween(100, 1000),
            'subscription_days' => $this->faker->numberBetween(30, 365),
        ];
    }
}
