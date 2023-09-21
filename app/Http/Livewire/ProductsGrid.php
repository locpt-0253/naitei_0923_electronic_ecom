<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductsGrid extends Component
{
    public $products;

    public function render()
    {
        return view('livewire.products-grid');
    }
}
