<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = Category::pluck('id')->toArray();

        $products = [
            ['Червона сукня', '1234567890123'],
            ['Сережки срібні', '1234567890124'],
            ['Туфлі на підборах', '1234567890125'],
            ['Сумка чорна класична', '1234567890126'],
            ['Парфуми жіночі Rose', '1234567890127'],
            ['Туш для вій Curlsy Black', '1234567890128'],
            ['Гребінець металевий', '1234567890129'],
            ['Шкарпетки з мереживом', '1234567890130'],
            ['Крем для рук', '1234567890131'],
            ['Спідниця плісирована', '1234567890132'],
        ];

        foreach ($products as [$name, $barcode]) {
            Product::create([
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(4),
                'barcode' => $barcode,
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'purchase_price' => rand(100, 500),
                'sale_price' => rand(600, 1200),
                'country' => 'Італія',
                'description' => 'Опис товару: ' . $name,
                'category_id' => $categoryIds[array_rand($categoryIds)],
            ]);
        }
    }
}
