<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class CategoryIndex extends Component
{
    public $categories;
    public $name;
    public $slug;
    public $categoryId = null;

    public $isEditing = false;

    protected $rules = [
        'name' => 'required|min:2',
    ];

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Category::orderBy('id', 'desc')->get();
    }

    public function save()
    {
        $this->validate();

        $slug = Str::slug($this->name);
        if (!$this->isEditing) {
            Category::create([
                'name' => $this->name,
                'slug' => $slug,
            ]);
        } else {
            $category = Category::findOrFail($this->categoryId);
            $category->update([
                'name' => $this->name,
                'slug' => $slug,
            ]);
        }

        $this->reset(['name', 'slug', 'categoryId', 'isEditing']);
        $this->loadCategories();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->isEditing = true;
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        $this->loadCategories();
    }

    public function render()
    {
        return view('livewire.admin.category-index');
    }
}
