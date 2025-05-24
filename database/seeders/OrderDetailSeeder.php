<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("order_details")->insert([
            [
                "order_id" => 1,
                "menu_id" => 1,
                "notes" => ""
            ],
            [
                "order_id" => 1,
                "menu_id" => 3,
                "notes" => "No chili"
            ],
            [
                "order_id" => 2,
                "menu_id" => 2,
                "notes" => "No sugar"
            ],
            [
                "order_id" => 2,
                "menu_id" => 4,
                "notes" => ""
            ],

        ]);
    }
}
