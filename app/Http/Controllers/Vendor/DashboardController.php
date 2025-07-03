<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Pet;
use App\Models\Product2;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $active_u = User::where('is_active', 1)->count();
        $users = User::where('utype', '!=', 'ADM')->count();
        $pets_c = Pet::where('status', '!=', 3)->count();
        $products_c = Product2::where('status', '!=', 3)->count();
        $categories = Category::where('status', '!=', 3)->get();
        $brands = Brand::where('status', '!=', 3)->get()->take(6);
        $users_data = User::where('is_active', 1)->latest()->get()->take(6);
        $products = Product2::where('status', '!=', 3)->latest()->get()->take(6);
        $pets = Pet::where('status', '!=', 3)->latest()->get()->take(6);
        // $topProducts=ProductVisit::take(10)->orderBy('visit_count','DESC')->get();
        $topProducts = OrderItem::select('product_id')->selectRaw('count(product_id) as qty')->groupBy('product_id')->orderBy('qty', 'DESC')->get()->take(8);
        // dd($topProducts);
        return view('vendor.dashboard', ['topProducts' => $topProducts, 'brands' => $brands, 'active_u' => $active_u, 'users' => $users, 'pets' => $pets, 'products_c' => $products_c, 'pets_c' => $pets_c, 'products' => $products, 'users_data' => $users_data, 'categories' => $categories])->layout('layouts.admin');
    }
}
