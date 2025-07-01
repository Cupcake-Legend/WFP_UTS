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
                'stock' => 20,
                'point' => 10,
                'category_id' => 5, // Tea
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Espresso',
                'deskripsi' => 'A strong and rich coffee with a smooth finish.',
                'harga' => 18000,
                'nutrisi' => 'Calories: 10, Fat: 0g, Sugar: 0g',
                'image' => 'espresso.jpg',
                'stock' => 30,
                'point' => 12,
                'category_id' => 5, // Coffee
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Taco',
                'deskripsi' => 'LeBron\'s favorite dish.',
                'harga' => 20000,
                'nutrisi' => 'Calories: 400, Fat: 0g, Sugar: 0g',
                'image' => 'taco.jpg',
                'stock' => 30,
                'point' => 12,
                'category_id' => 1, // Snacks
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Choco Cake',
                'deskripsi' => 'A moist chocolate cake topped with creamy frosting.',
                'harga' => 22000,
                'nutrisi' => 'Calories: 350, Fat: 20g, Sugar: 30g',
                'image' => 'choco_cake.jpg',
                'stock' => 15,
                'point' => 15,
                'category_id' => 2, // Desserts
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Strawberry Smoothie',
                'deskripsi' => 'A sweet and creamy smoothie made with real strawberries.',
                'harga' => 25000,
                'nutrisi' => 'Calories: 180, Fat: 2g, Sugar: 22g',
                'image' => 'strawberry_smoothie.jpg',
                'stock' => 25,
                'point' => 13,
                'category_id' => 5, // Smoothies
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chicken Sandwich',
                'deskripsi' => 'Grilled chicken with fresh lettuce and mayo in a soft bun.',
                'harga' => 27000,
                'nutrisi' => 'Calories: 300, Fat: 10g, Sugar: 5g',
                'image' => 'chicken_sandwich.jpg',
                'stock' => 20,
                'point' => 14,
                'category_id' => 3, // Sandwiches
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Breakfast Burrito',
                'deskripsi' => 'Eggs, cheese, and sausage wrapped in a tortilla.',
                'harga' => 28000,
                'nutrisi' => 'Calories: 400, Fat: 18g, Sugar: 2g',
                'image' => 'breakfast_burrito.jpg',
                'stock' => 15,
                'point' => 16,
                'category_id' => 4, // Breakfast
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Iced Lemon Tea',
                'deskripsi' => 'Cool and tangy iced tea with a slice of lemon.',
                'harga' => 17000,
                'nutrisi' => 'Calories: 60, Fat: 0g, Sugar: 14g',
                'image' => 'iced_lemon_tea.jpg',
                'stock' => 20,
                'point' => 11,
                'category_id' => 5, // Beverages
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
