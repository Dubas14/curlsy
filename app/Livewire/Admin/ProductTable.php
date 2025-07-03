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

    public function handleReorderProduct($data)
    {
        logger('🔥 Перетягнуто товар:', $data);

        // Онови категорію
        Product::find($data['product_id'])->update([
            'category_id' => $data['new_category_id']
        ]);

        // Можеш також зберегти порядок (якщо треба)
        foreach ($data['ordered_ids'] as $index => $id) {
            Product::where('id', $id)->update(['sort_order' => $index]);
        }

        $this->loadProducts($data['new_category_id']);
    }

    public function render()
    {
        return view('livewire.admin.product-table');
    }
}
