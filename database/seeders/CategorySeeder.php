<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = json_decode(
            File::get(database_path('data/categories.json')),
            true
        );

        foreach ($categories as $category) {
            $categoryModel = Category::withTrashed()
                ->updateOrCreate(
                    ['id' => $category['category_id']],
                    [
                        'category_title' => $category['category_title'],
                        'category_description' => null,
                        'status' => true,
                    ]
                );

            if ($categoryModel->trashed()) {
                $categoryModel->restore();
            }
        }
    }
}