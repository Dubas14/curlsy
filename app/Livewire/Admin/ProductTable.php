<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class ProductTable extends Component
{
    public $selectedCategoryId = null;
    public $categoryName = null;
    public $products = [];
    public $editProductId = null;
    public $editData = [];

    public $categories = []; // ← додаємо список категорій

    protected $listeners = [
        'category-selected' => 'loadProducts',
    ];

    protected $rules = [
        'editData.name' => 'required|string|min:2',
        'editData.sale_price' => 'required|numeric',
        'editData.country' => 'nullable|string',
        'editData.description' => 'nullable|string',
        'editData.category_id' => 'required|exists:categories,id', // ← додаємо перевірку
    ];

    public function mount()
    {
        $this->categories = Category::all(); // ← завантажуємо категорії
    }

    public function loadProducts($id): void
    {
        $this->resetEditingState();

        $category = Category::findOrFail($id);
        $this->selectedCategoryId = $category->id;
        $this->categoryName = $category->name;

        $this->products = $category->products()->get();
    }

    public function edit($id): void
    {
        $product = Product::findOrFail($id);
        $this->editProductId = $id;

        // додаємо category_id
        $this->editData = $product->only([
            'name',
            'sale_price',
            'country',
            'description',
            'category_id'
        ]);
    }

    public function update(): void
    {
        $this->validate();

        $product = Product::findOrFail($this->editProductId);
        $product->update($this->editData);

        $this->resetEditingState();

        // якщо категорія змінилась — оновлюємо список
        $this->loadProducts($this->selectedCategoryId);
    }

    public function delete($id): void
    {
        Product::findOrFail($id)->delete();
        $this->loadProducts($this->selectedCategoryId);
    }

    private function resetEditingState(): void
    {
        $this->editProductId = null;
        $this->editData = [];
    }

    public function render()
    {
        return view('livewire.admin.product-table');
    }
}
