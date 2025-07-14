<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MedType;
use App\Models\Product2;
use App\Models\Breed;

class MobileSidebarComponent extends Component
{
    public $min_price;
    public $max_price;
    public $max,$min;
    public function mount()
    {
       $this->min =Product2::where('status',1)->min('regular_price');
        $this->max =Product2::where('status',1)->max('regular_price');
       $this->min_price =$this->min;
        $this->max_price=$this->max;
    }
    public function render()
    {
        $categorys = Category::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
         $medtypes = MedType::where('status',1)->get();
         $breeds = Breed::where('status',1)->get();
        return view('livewire.mobile-sidebar-component',['breeds'=>$breeds,'categorys'=>$categorys,'brands'=>$brands,'medtypes'=>$medtypes]);
    }
}
