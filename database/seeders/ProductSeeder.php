<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = json_decode(
            File::get(database_path('data/products.json')),
            true
        );

        foreach ($products as $product) {
            $productModel = Product::withTrashed()
                ->updateOrCreate(
                    ['id' => $product['product_id']],
                    [
                        'product_title' => $product['title'],
                        'category_id' => $product['category_id'],
                        'author_id' => $product['author_id'],
                        'list_price' => $product['list_price'],
                        'stock_quantity' => $product['stock_quantity'],
                        'status' => true,
                    ]
                );

            if ($productModel->trashed()) {
                $productModel->restore();
            }
        }
    }
}