<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\OrderDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            MenuSeeder::class,
            PaymentMethodSeeder::class,
            RewardSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            RewardDetailSeeder::class,
            NotificationSeeder::class
        ]);
    }
}
