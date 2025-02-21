<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search;
    public $perPage=10;
    protected $updateQueryString = ['search'=>['except'=>'']];
    public function render()
    {
        return view('livewire.product.index',[
            'products'=> $this->search === null ? 
            Product::latest()->paginate($this->perPage) : 
            Product::latest()->where('name','like','%'.$this->search.'%')
            ->paginate($this->perPage) 
        ]);
    }
}
