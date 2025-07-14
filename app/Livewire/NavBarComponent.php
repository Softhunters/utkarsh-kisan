<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Session;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Models\Websetting;

class NavBarComponent extends Component
{
     public  $cartcount;
    public  $wishcount;
    public function render()
    {
        $categorys = Category::where('status', 1)->where('status', '!=', 3)->get();
        $subcategorys = SubCategory::where('status', 1)->where('status', '!=', 3)->get();
        $this->wishcount = 0;
        $this->cartcount = 0;
        if(Auth::check())
        {
            $this->wishcount = Wishlist::where('user_id',Auth::user()->id)->get()->count();
            $this->cartcount = Cart::where('user_id',Auth::user()->id)->get()->count();

        }else{
            if (Session::has('wishlist')){
                $this->wishcount = count(session()->get('wishlist'));
            }
            if (Session::has('cart')){
                $this->cartcount = count(session()->get('cart'));
            }
        }
        $setting = Websetting::find(1); 
        return view('livewire.nav-bar-component',['categorys'=>$categorys,'subcategorys'=>$subcategorys,'setting'=>$setting]);
    }
}