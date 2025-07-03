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

    protected $listeners = [
        'category-selected' => 'loadProducts',
        'reorder-product' => 'handleReorderProduct',
    ];

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
        logger("Load products for category ID $id");

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
    public function selectCategory($id)
    {
        $this->loadProducts($id);
    }

    public function reorder(array $orderedIds): void
    {
        if (empty($orderedIds)) return;

        \DB::transaction(function () use ($orderedIds) {
            foreach ($orderedIds as $order => $id) {
                Product::where('id', $id)->update(['position' => $order + 1]);
            }
        });

        $this->loadProducts($this->selectedCategoryId);
    }

    public function handleReorderProduct($data): void
    {
        $product = Product::find($data['product_id']);
        if (!$product) return;

        \DB::transaction(function () use ($data, $product) {
            $product->update(['category_id' => $data['new_category_id']]);

            if (!empty($data['ordered_ids'])) {
                foreach ($data['ordered_ids'] as $position => $id) {
                    Product::where('id', $id)->update(['position' => $position + 1]);
                }
            }
        });

        $this->selectedCategoryId = $data['new_category_id'];
        $this->loadProducts($this->selectedCategoryId);
        $this->dispatch('category-selected', $this->selectedCategoryId);
    }

    public function render()
    {
        return view('livewire.admin.product-table');
    }
}
