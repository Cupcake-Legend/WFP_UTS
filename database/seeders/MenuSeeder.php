<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'name' => 'Green Tea',
                'deskripsi' => 'A refreshing green tea with subtle earthy notes.',
                'harga' => 15000,
                'nutrisi' => 'Calories: 5, Fat: 0g, Sugar: 0g',
                'image' => 'green_tea.jpg',
                'porsi' => 'Medium',
                'stock' => 20,
                'point' => 10,
                'category_id' => 1,
            ],
            [
                'name' => 'Espresso',
                'deskripsi' => 'A strong and rich coffee with a smooth finish.',
                'harga' => 18000,
                'nutrisi' => 'Calories: 10, Fat: 0g, Sugar: 0g',
                'image' => 'espresso.jpg',
                'porsi' => 'Small',
                'stock' => 30,
                'point' => 12,
                'category_id' => 2,
            ],
            [
                'name' => 'Taco',
                'deskripsi' => 'LeBron\'s favorite dish',
                'harga' => 20000,
                'nutrisi' => 'Calories: 400, Fat: 0g, Sugar: 0g',
                'image' => 'taco.jpg',
                'porsi' => 'Small',
                'stock' => 30,
                'point' => 12,
                'category_id' => 2,
            ],
            [
                'name' => 'Choco Cake',
                'deskripsi' => 'A moist chocolate cake topped with creamy frosting.',
                'harga' => 22000,
                'nutrisi' => 'Calories: 350, Fat: 20g, Sugar: 30g',
                'image' => 'choco_cake.jpg',
                'porsi' => 'Large',
                'stock' => 15,
                'point' => 15,
                'category_id' => 4,
            ],
        ]);
    }
}
