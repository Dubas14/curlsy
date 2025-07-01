<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class ProductIndex extends Component
{
    public $categories;

    public $editProductId = null;
    public $editData = [];

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Category::with('products')->get();
    }

    public function startEdit($productId)
    {
        $product = Product::findOrFail($productId);
        $this->editProductId = $productId;
        $this->editData = $product->only([
            'name', 'purchase_price', 'sale_price',
            'country', 'description', 'category_id'
        ]);
    }

    public function save()
    {
        $this->validate([
            'editData.name' => 'required|string|min:2',
            'editData.purchase_price' => 'required|numeric',
            'editData.sale_price' => 'required|numeric',
            'editData.category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($this->editProductId);
        $product->update($this->editData);

        $this->editProductId = null;
        $this->editData = [];

        $this->loadCategories();
    }

    public function cancel()
    {
        $this->editProductId = null;
        $this->editData = [];
    }

    public function delete($productId)
    {
        Product::findOrFail($productId)->delete();
        $this->loadCategories();
    }

    public function render()
    {
        return view('livewire.admin.product-index');
    }
}
