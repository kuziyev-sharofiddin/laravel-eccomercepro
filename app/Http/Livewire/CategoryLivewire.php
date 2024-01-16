<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Service\CategoryService;

class CategoryLivewire extends Component
{
    public function __construct(protected CategoryService $categoryService)
    {

    }

    public $categories;

    public function mount($categories){
        $this->$categories = $this->categoryService->getByPaginate(10);
    }



    public function render()
    {
        return view('livewire.category-livewire');
    }
}
