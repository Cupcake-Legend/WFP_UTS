<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table("rewards")->insert([
            [
                "name" => "Promo Lebron",
                "poin" => 1000,
                "menu_id" => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Promo Mahasiswa",
                "poin" => 2000,
                "menu_id" => 2,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Promo Pekerja",
                "poin" => 1500,
                "menu_id" => 3,
                "created_at" => now(),
                "updated_at" => now()
            ],

        ]);
    }
}
