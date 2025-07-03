<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Pet;
use App\Models\Brand;
use App\Models\OrderItem;

class DashboardComponent extends Component
{
    public function render()
    {
        $active_u=User::where('is_active',1)->count();
        $users=User::where('utype','!=','ADM')->count();
        $products_c=Product::where('status','!=',3)->count();
        $categories=Category::where('status','!=',3)->get();
        $brands=Brand::where('status','!=',3)->get()->take(6);
        $users_data=User::where('is_active',1)->latest()->get()->take(6);
        $products = Product::where('status','!=',3)->latest()->get()->take(6);
        // $topProducts=OrderItem::select('product_id')->selectRaw('count(product_id) as qty')->groupBy('product_id')->orderBy('qty', 'DESC')->get()->take(8);
     
        return view('livewire.admin.dashboard-component',['brands' => $brands, 'active_u'=>$active_u,'users'=>$users,'products_c'=>$products_c,'products'=>$products,'users_data'=>$users_data,'categories'=>$categories])->layout('layouts.admin');
    }
}
