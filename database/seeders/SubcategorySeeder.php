<?php

namespace Database\Seeders;

use Domains\Category\Models\Category;
use Domains\Category\Models\Subcategory;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::factory(['name' => 'Tools'])->create();

        Subcategory::factory([
            'category_id' => $category->id,
        ])->count(20)->create();
    }
}
