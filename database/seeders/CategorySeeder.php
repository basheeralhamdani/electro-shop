<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Lights'],
            ['name' => 'Computers'],
            ['name' => 'Audio'],
            ['name' => 'Appliances'],
            ['name' => 'Accessories'],
            ['name' => 'Phone'],
            ['name' => 'Camera'],
            ['name' => 'Car'],
        ]);
    }
}