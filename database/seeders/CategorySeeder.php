<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'category' => 'Fé',
        ]);
        Category::create([
            'category' => 'Amor',
        ]);
        Category::create([
            'category' => 'Cristo',
        ]);
        Category::create([
            'category' => 'Poesia',
        ]);
        
    }
}
