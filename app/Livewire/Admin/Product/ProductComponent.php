<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;

class ProductComponent extends Component
{
    public function DeactiveProduct($id)
    {
        $category = Product::find($id);
        $category->status=0;
        $category->save();
        session()->flash('message','Product has been Deactive successfully!');
        $this->js('window.location.reload()');
    }
    public function ActiveProduct($id)
    {
        $category = Product::find($id);
        $category->status=1;
        $category->save();
        session()->flash('message','Product has been Active successfully!');
        $this->js('window.location.reload()');
    }
    public function deleteProduct($id)
    {
        $category = Product::find($id);
        $category->status=3;
        $category->save();
        session()->flash('message','Product has been deleted successfully!');
        $this->js('window.location.reload()');
    }
    public function render()
    {
        $products=Product::where('status','!=',3)->get();
        return view('livewire.admin.product.product-component',['products'=>$products])->layout('layouts.admin');
    }
}