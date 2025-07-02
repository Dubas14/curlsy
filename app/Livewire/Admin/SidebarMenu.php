<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

class SidebarMenu extends Component
{
    public $categories;
    public $selectedCategoryId = null; // Додана публічна змінна для відстеження вибраної категорії

    protected $listeners = [
        'category-selected' => 'setSelectedCategory',
    ];

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Category::orderBy('name')->get();
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategoryId = $categoryId;
        $this->dispatch('category-selected', $categoryId);

        // Якщо потрібно оновити стан самого компонента
        $this->render();
    }

    public function setSelectedCategory($categoryId)
    {
        $this->selectedCategoryId = $categoryId;
    }

    public function render()
    {
        return view('livewire.admin.sidebar-menu', [
            'selectedCategoryId' => $this->selectedCategoryId // Явно передаємо змінну у view
        ]);
    }
}
