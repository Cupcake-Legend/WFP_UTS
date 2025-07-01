<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
           
            [
                'name' => 'Snacks',
                'deskripsi' => 'Light bites and snacks to pair with drinks.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Desserts',
                'deskripsi' => 'Sweet treats to satisfy your cravings.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sandwiches',
                'deskripsi' => 'Freshly made sandwiches and wraps.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Breakfast',
                'deskripsi' => 'Morning meals including eggs, toast, and cereal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Beverages',
                'deskripsi' => 'A variety of cold and hot beverages.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
