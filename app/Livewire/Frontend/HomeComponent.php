<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Slider;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;

class HomeComponent extends Component
{
    public $cartp = [];
    public $wishp = [];

    public function addToWishlist(Request $request, $product_id, $product_price, $seller_id = null)
    {
        $id = $product_id;
        $seller_id = $seller_id ?? 1;
        if (Auth::check()) {
            $wproduct = Wishlist::where('product_id', $product_id)->where('user_id', Auth::user()->id)
                ->where('seller_id', $seller_id)->first();
            if ($wproduct) {
                session()->flash('info', 'Item alreday added to Wishlist');
                return;
            } else {
                $product = Product::where('id', $product_id)->first();
                $wishlist = new Wishlist();
                $wishlist->user_id = Auth::user()->id;
                $wishlist->product_id = $product_id;
                $wishlist->product_name = $product->name;
                $wishlist->product_image = $product->image;
                $wishlist->price = $product->sale_price;
                $wishlist->quantity = '1';
                $wishlist->seller_id = $seller_id;
                $wishlist->save();
                session()->flash('success', 'Item added to Wishlist!');
                // $this->dispatch('wishlist-count-component');
                $this->dispatch('wishlist_add');
                return;
            }
        } else {
            $product = Product::where('id', $product_id)->first();
            $wishlist = $request->session()->get('wishlist');


            $wishlist[$id] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_image' => $product->image,
                'quantity' => '1',
                'seller_id' => $seller_id,
                'price' => $product->sale_price
            ];
            Session()->put('wishlist', $wishlist);


            session()->flash('success', 'Item added to Wishlist!');
            $this->dispatch('wishlist_add');

        }

        //  $this->dispatch('wishlist-count-component','refreshComponent');
        return;
    }

    public function removeFromWishlist(Request $request, $product_id, $seller_id = null)
    {
        $seller_id = $seller_id ?? 1;
        if (Auth::check()) {
            $wishlist = Wishlist::where('product_id', $product_id)->where('user_id', Auth::user()->id)
                ->where('seller_id', $seller_id)->first();
            if ($wishlist) {
                $wishlist->delete();
                session()->flash('warning', 'Item remove from Wishlist!');
                // $this->dispatch('wishlist-count-component','refreshComponent');
                $this->dispatch('wishlist_add');
                return;
            }
        } else {
            if (Session::has('wishlist')) {

                $wishlistdf = $request->session()->get('wishlist');
                unset($wishlistdf[$product_id]);
                Session()->put('wishlist', $wishlistdf);
                // dd($wishlistdf);
                session()->flash('warning', 'Item remove from Wishlist!');
                // $this->dispatch('wishlist-count-component','refreshComponent');
                $this->dispatch('wishlist_add');
                return;

            }
        }
        return;
    }
    public function AddtoCart(Request $request, $product_id, $product_price, $seller_id = null)
    {
        $id = $product_id;
        $seller_id = $seller_id ?? 1;
        if (Auth::check()) {
            $wproduct = Cart::where('product_id', $product_id)->where('user_id', Auth::user()->id)
                ->where('seller_id', $seller_id)->first();
            if ($wproduct) {
                session()->flash('info', 'Item alreday added to Cart!');
                return;
            } else {
                $product = Product::where('id', $product_id)->first();
                // if($this->quntiti >= $product->quantity)
                // {
                //     session()->flash('message','Item Quantity is not perest');
                //     return;
                // }else{
                $cart = new Cart();
                $cart->user_id = Auth::user()->id;
                $cart->product_id = $product_id;
                $cart->product_name = $product->name;
                $cart->product_image = $product->image;
                $cart->price = $product->sale_price;
                $cart->quantity = '1';
                $cart->seller_id = $seller_id;
                $cart->save();
                session()->flash('success', 'Item added to Cart!');
                // $this->dispatch('wishlist-count-component','refreshComponent');
                $this->dispatch('cart_add');
                return;
                // }
            }
        } else {
            $product = Product::where('id', $product_id)->first();
            $cart = $request->session()->get('cart');


            $cart[$id] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_image' => $product->image,
                'quantity' => '1',
                'seller_id' => $seller_id,
                'price' => $product->sale_price
            ];
            Session()->put('cart', $cart);


            session()->flash('success', 'Item added to Cart!');
            $this->dispatch('cart_add');
        }

        //  $this->dispatch('wishlist-count-component','refreshComponent');
        return;
    }
    public function render(Request $request)
    {
        if (Auth::check()) {
            $this->cartp = Cart::where('user_id', Auth::user()->id)->pluck('product_id')->toArray();
            $this->wishp = Wishlist::where('user_id', Auth::user()->id)->pluck('product_id')->toArray();
        } else {
            if (Session::has('cart')) {
                $cartlist = $request->session()->get('cart');
                $this->cartp = array_keys($cartlist);
            }
            if (Session::has('wishlist')) {
                $wish = $request->session()->get('wishlist');
                $this->wishp = array_keys($wish);
            }
        }
        $sliders = Slider::where('for', 'home')->where('status', 1)->get();
        $categorys = Category::where('is_home', 1)->where('status', 1)->get();
        $subcategorys = SubCategory::where('is_home', 1)->where('status', 1)->get();
        $brands = Brand::where('is_home', 1)->where('status', 1)->get();
        $banners = Banner::where('status', 1)->where('for', 'home')->get();
        // $cbanners = Banner::where('status',1)->where('for','1')->get();
        $products = Product::whereHas('vendorProducts')->with(['seller', 'category', 'subCategories'])
            ->where('featured', '!=', 1)
            ->where('sale_price', '>', 0)
            ->where('status', 1)
            ->where('stock_status', 'instock')
            ->inRandomOrder()
            ->take(8)
            ->get();

        $fproducts = Product::whereHas('vendorProducts')->with(['seller', 'category', 'subCategories'])
            ->where('featured', 1)
            ->where('status', 1)
            ->where('stock_status', 'instock')
            ->inRandomOrder()
            ->take(8)
            ->get();

        $oproducts = Product::whereHas('vendorProducts')->with(['seller', 'category', 'subCategories'])
            ->where('sale_price', '>', 0)
            ->where('status', 1)
            ->where('discount_value', '>', 10)
            ->where('stock_status', 'instock')
            ->whereHas('category', function ($q) {
                $q->where('status', 1)->where('is_home', 1);
            })
            ->whereHas('subCategories', function ($q) {
                $q->where('status', 1)->where('is_home', 1);
            })
            ->inRandomOrder()
            ->take(12)
            ->get();

        // // $products = Product::where('sale_price','>',0)->where('status',1)->where('featured',1)->where('stock_status','instock')->inRandomOrder()->get()->take(12);
        $testimonials = Testimonial::where('status',1)->get();
        //    dd($fproducts); 
        return view('livewire.frontend.home-component', compact('testimonials', 'banners', 'sliders', 'oproducts', 'fproducts', 'categorys', 'subcategorys', 'products', 'brands'))->layout('layouts.main');
    }
}