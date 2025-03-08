<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = \App\Models\Category::all();
        foreach ($categories as $category) {
            \App\Models\Product::factory()->withCategory($category->id)
                ->count(20)
                ->create();
        }
    }
}
