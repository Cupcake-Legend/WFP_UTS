<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            [
                "name" => "James",
                "password" => Hash::make("123456"),
                "email" => "james@gmail.com",
                "no_hp" => "08123456789",
                "alamat" => "Jl Ubaya Surabaya",
                "poin" => 0,
                "roles" => "admin",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Nico",
                "password" => Hash::make("123456"),
                "email" => "nico@gmail.com",
                "no_hp" => "08123456789",
                "alamat" => "Jl Ubaya Tenggilis",
                "poin" => 0,
                "roles" => "user",
                "created_at" => now(),
                "updated_at" => now()
            ],

        ]);
    }
}
