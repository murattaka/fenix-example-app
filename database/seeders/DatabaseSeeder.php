<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => true,
        ]);

        Device::factory()->create(
            [
                'uuid' => 'ec7cd3bd-33e1-3ab2-b19c-088905750127',
                'user_id' => 1,
                'name' => 'Test Device',
                'user_agent' => 'Test User Agent',
                'platform' => 'Test Platform',
            ]
        );

        Product::factory()->create(
            [
                'id' => 'test-product',
                'name' => 'Test Product',
                'price' => 100,
                'subscription_days' => 30,
            ]
        );

        User::factory(10)->create();

        $this->call([
            DeviceSeeder::class,
            ProductSeeder::class,
            SubscriptionSeeder::class,
            ChatSeeder::class,
            MessageSeeder::class,
        ]);

    }
}
