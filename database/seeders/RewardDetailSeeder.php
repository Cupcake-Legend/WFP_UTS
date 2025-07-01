<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("reward_details")->insert([
            [
                "reward_id" => 1,
                "user_id" => 2,
                "is_claimed" => "NO",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "reward_id" => 2,
                "user_id" => 2,
                "is_claimed" => "NO",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "reward_id" => 3,
                "user_id" => 2,
                "is_claimed" => "NO",
                "created_at" => now(),
                "updated_at" => now()
            ],
        ]);
    }
}
