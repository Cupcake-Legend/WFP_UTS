<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("payment_methods")->insert([
            [
                "name" => "DEBIT",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "CREDIT",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "CASH",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ]);
    }
}
