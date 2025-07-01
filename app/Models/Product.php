<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'barcode',
        'sku',
        'purchase_price',
        'sale_price',
        'country',
        'description',
        'category_id',
        'position',
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->sku = 'SKU-' . strtoupper(Str::random(8));
            $product->slug = Str::slug($product->name) . '-' . Str::random(4);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
