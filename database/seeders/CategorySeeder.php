<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Сукні',
            'Аксесуари',
            'Косметика',
            'Парфуми',
            'Взуття',
            'Сумки',
            'Біжутерія',
            'Головні убори',
            'Спідня білизна',
            'Шкарпетки'
        ];

        foreach ($categories as $name) {
            $slug = Str::slug($name);

            if (!Category::where('slug', $slug)->exists()) {
                Category::create([
                    'name' => $name,
                    'slug' => $slug,
                    'parent_id' => null,
                ]);
            }
        }
    }
}
