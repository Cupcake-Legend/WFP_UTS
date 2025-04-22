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
                'name' => 'Tea',
                'deskripsi' => 'Various types of tea including green, black, and herbal.',
            ],
            [
                'name' => 'Coffee',
                'deskripsi' => 'Different coffee blends and styles.',
            ],
            [
                'name' => 'Snacks',
                'deskripsi' => 'Light bites and snacks to pair with drinks.',
            ],
            [
                'name' => 'Desserts',
                'deskripsi' => 'Sweet treats to satisfy your cravings.',
            ],
        ]);
    }
}
