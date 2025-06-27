<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class SearchBar extends Component
{
    public $query = '';
    public $results = [];

    public function updatedQuery()
    {
        $this->results = Product::where('name', 'like', '%'.$this->query.'%')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.search-bar', [
            'query' => $this->query,
            'results' => $this->results
        ]);
    }
}
