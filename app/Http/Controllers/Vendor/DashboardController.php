<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Pet;
use App\Models\Product;
use App\Models\User;
use App\Models\VendorProduct;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $active_u = User::where('is_active', 1)->count();
        $users = User::where('utype', '!=', 'ADM')->count();
        $products_c = Product::where('status', '!=', 3)->count();
        $categories = Category::where('status', '!=', 3)->get();
        $brands = Brand::where('status', '!=', 3)->get()->take(6);
        $users_data = User::where('is_active', 1)->latest()->get()->take(6);
        $products = Product::whereHas('vendorProducts', function ($q) {
            $q->where('vendor_id', Auth::id());
        })
            ->where('status', '!=', 3)->latest()->get()->take(6);

        $topSellingProducts = Product::select('products.id', 'products.slug', 'products.name', 'products.image', DB::raw('SUM(orderitems.quantity) as total_sold'))
            ->join('orderitems', 'products.id', '=', 'orderitems.product_id')
            ->join('vendor_products', 'products.id', '=', 'vendor_products.product_id')
            ->where('vendor_products.vendor_id', Auth::id())
            ->groupBy('products.id',  'products.slug', 'products.name', 'products.image',)
            ->orderByDesc('total_sold')
            ->where('products.status', '!=', 3)
            ->take(6)
            ->get();


        $totalProducts = Product::where('status', 1)->where('status', '!=', 3)->count();
        $totalSellers = User::where('utype', 'VDR')->count();
        $vendorProducts = VendorProduct::where('vendor_id', Auth::id())->count();
        $totalVendorOrders = OrderItem::where('seller_id', Auth::id())->count();

        return view('vendor.dashboard', ['totalProducts' => $totalProducts, 'totalSellers' => $totalSellers, 'vendorProducts' => $vendorProducts, 'totalVendorOrders' => $totalVendorOrders, 'topSellingProducts' => $topSellingProducts, 'active_u' => $active_u, 'users' => $users, 'products_c' => $products_c, 'products' => $products, 'users_data' => $users_data, 'categories' => $categories])->layout('layouts.admin');
    }
}
