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
    public $categories = [];

    protected $listeners = ['category-selected' => 'loadProducts'];

    protected $rules = [
        'editData.name' => 'required|string|min:2',
        'editData.sale_price' => 'required|numeric',
        'editData.country' => 'nullable|string',
        'editData.description' => 'nullable|string',
        'editData.category_id' => 'required|exists:categories,id',
    ];

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function loadProducts($id): void
    {
        $this->resetEditingState();
        $category = Category::findOrFail($id);
        $this->selectedCategoryId = $category->id;
        $this->categoryName = $category->name;
        $this->products = Product::where('category_id', $id)->orderBy('position')->get();
    }

    public function edit($id): void
    {
        $product = Product::findOrFail($id);
        $this->editProductId = $id;
        $this->editData = $product->only(['name', 'sale_price', 'country', 'description', 'category_id']);
    }

    public function update(): void
    {
        $this->validate();
        $product = Product::findOrFail($this->editProductId);
        $product->update($this->editData);
        $this->resetEditingState();
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

    public function reorder($orderedIds)
    {
        foreach ($orderedIds as $order => $id) {
            Product::where('id', $id)->update(['position' => $order + 1]);
        }

        $this->loadProducts($this->selectedCategoryId);
    }

    public function render()
    {
        return view('livewire.admin.product-table');
    }
}
