<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("orders")->insert([
            [
                "status" => "PROCESS",
                "order_method" => "DINEIN",
                "total" => 35000,
                "user_id" => 2,
                "payment_method_id" => "1"
            ],
            [
                "status" => "DONE",
                "order_method" => "TAKEAWAY",
                "total" => 40000,
                "user_id" => 2,
                "payment_method_id" => "2"
            ]
        ]);
    }
}
