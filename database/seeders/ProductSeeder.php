<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Category 1', 'Category 2', 'Category 3', 'Category 4', 'Category 5'];
        $productNames = ['Cool', 'Awesome', 'Fantastic', 'Innovative', 'Sleek', 'Gorgeous', 'Elegant', 'Dazzling', 'Vibrant', 'Stylish'];

        $products = [];

        for ($i = 1; $i <= 50; $i++) {
            $productName = $productNames[array_rand($productNames)] . ' Product ' . $i;
            $category = $categories[$i % count($categories)];
            $price = rand(5, 100) + 0.99 * $i;

            $imageId = rand(1, 1000); // Generate a random image ID
            $image = "https://picsum.photos/id/{$imageId}/200";

            $products[] = [
                'name' => $productName,
                'category' => $category,
                'price' => $price,
                'image' => $image,
            ];
        }

        foreach ($products as $product) {
            Product::create($product);
        }
    }

}