<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::doesntHave('subscription')->get()->random()->id,
            'product_id' => Str::slug(Product::all()->random()->name),
            'payment_status' => Arr::random(['pending', 'success', 'failed']),
            'receipt_token' => Str::random(100),
            'expires_at' => $this->faker->dateTime(),
        ];
    }
}
