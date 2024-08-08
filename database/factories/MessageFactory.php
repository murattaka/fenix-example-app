<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'chat_id' => \App\Models\Chat::all()->random()->id,
            'content' => $this->faker->sentences(3, true),
            'status' => $this->faker->randomElement(['failed', 'progressed']),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (\App\Models\Message $message) {
            \App\Models\CreditHistory::create([
                'user_id' => $message->chat->user_id,
                'credit' => rand(1, 10),
                'message_id' => $message->id,
            ]);
        });

    }
}
