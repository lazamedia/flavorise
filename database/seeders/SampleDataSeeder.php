<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Menu;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories
        $categories = [
            [
                'name' => 'Makanan Utama',
                'description' => 'Menu makanan utama restoran',
                'is_active' => true,
            ],
            [
                'name' => 'Minuman',
                'description' => 'Menu minuman segar',
                'is_active' => true,
            ],
            [
                'name' => 'Dessert',
                'description' => 'Menu penutup dan dessert',
                'is_active' => true,
            ],
            [
                'name' => 'Snack',
                'description' => 'Menu cemilan dan appetizer',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Create sample menus
        $menus = [
            // Makanan Utama
            [
                'category_id' => 1,
                'name' => 'Nasi Gudeg',
                'description' => 'Nasi gudeg khas Yogyakarta dengan ayam dan telur',
                'price' => 25000,
                'stock' => 50,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Ayam Bakar',
                'description' => 'Ayam bakar bumbu kecap dengan nasi dan lalapan',
                'price' => 30000,
                'stock' => 30,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Soto Ayam',
                'description' => 'Soto ayam kuning dengan telur dan kerupuk',
                'price' => 20000,
                'stock' => 40,
                'is_available' => true,
            ],
            
            // Minuman
            [
                'category_id' => 2,
                'name' => 'Es Teh Manis',
                'description' => 'Es teh manis segar',
                'price' => 5000,
                'stock' => 100,
                'is_available' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Es Jeruk',
                'description' => 'Es jeruk peras segar',
                'price' => 8000,
                'stock' => 80,
                'is_available' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Kopi Hitam',
                'description' => 'Kopi hitam panas atau dingin',
                'price' => 10000,
                'stock' => 60,
                'is_available' => true,
            ],
            
            // Dessert
            [
                'category_id' => 3,
                'name' => 'Es Krim Vanilla',
                'description' => 'Es krim vanilla dengan topping',
                'price' => 15000,
                'stock' => 25,
                'is_available' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Puding Coklat',
                'description' => 'Puding coklat dengan saus karamel',
                'price' => 12000,
                'stock' => 20,
                'is_available' => true,
            ],
            
            // Snack
            [
                'category_id' => 4,
                'name' => 'Kerupuk Udang',
                'description' => 'Kerupuk udang renyah',
                'price' => 3000,
                'stock' => 200,
                'is_available' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Tahu Goreng',
                'description' => 'Tahu goreng dengan saus kacang',
                'price' => 8000,
                'stock' => 50,
                'is_available' => true,
            ],
        ];

        foreach ($menus as $menuData) {
            Menu::create($menuData);
        }
    }
}