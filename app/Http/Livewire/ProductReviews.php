<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductReviews extends Component
{
    public $product;
    public $allReviews;
    public $shownReviews;
    public $currentFilter;

    public function mount()
    {
        $this->allReviews = $this->product->reviews;
        $this->shownReviews = $this->allReviews;
        $this->currentFilter = 'all';
    }

    public function all()
    {
        $this->shownReviews = $this->allReviews;
        $this->currentFilter = 'all';
    }

    public function filterOnStar($star)
    {
        $this->shownReviews = $this->allReviews->filter(function ($value) use ($star) {
            return $value->star == $star;
        });
        $this->currentFilter = $star . 'star';
    }

    public function render()
    {
        return view('livewire.product-reviews');
    }
}
