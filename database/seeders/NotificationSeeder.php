<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("notifications")->insert([
            [
                "isi" => "Order sedang diproses!",
                "order_id" => 1
            ],
            [
                "isi" => "Order sedang diproses!",
                "order_id" => 2
            ],
            [
                "isi" => "Order selesai!",
                "order_id" => 2
            ],
        ]);
    }
}
