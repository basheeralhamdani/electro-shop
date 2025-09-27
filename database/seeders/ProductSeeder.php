<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // <-- تأكد من إضافة هذا السطر

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Car Lights',
            'description' => 'Lorem ipsum dolor sit amet consectetur.',
            'price' => 400.00,
            'image' => 'pexels-darius-krause-2470657.jpg',
            'category_id' => 1 // ID for 'Lights' category
        ]);

        Product::create([
            'name' => 'Laptop processor',
            'description' => 'Lorem ipsum dolor sit.',
            'price' => 2000.00,
            'image' => 'pexels-athena-2582935.jpg',
            'category_id' => 2 // ID for 'Computers' category
        ]);
        
        Product::create([
            'name' => 'Speaker',
            'description' => 'Lorem ipsum dolor sit amet.',
            'price' => 1000.00,
            'image' => 'pexels-pixabay-373638.jpg',
            'category_id' => 3 // ID for 'Audio' category
        ]);
    }
}