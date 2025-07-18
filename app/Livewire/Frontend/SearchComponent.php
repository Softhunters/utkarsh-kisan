<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Session;
use App\Models\Wishlist;

class SearchComponent extends Component
{
    public $sorting;
    public $pagesize;
    public $min_price;
    public $max_price;
    public $search;
    public $brandtype = [];
    public $discount = [];
    public $wishp = [];
    public $cartp = [];
    public $max, $min;

    public function mount(Request $request)
    {
        $this->sorting = "default";
        $this->pagesize = "12";
        $this->min = Product::where('status', 1)->min('sale_price');
        $this->max = Product::where('status', 1)->max('sale_price');
        $this->min_price = $this->min;
        $this->max_price = $this->max;
        $this->search = $request->search;

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
        $category_id = Category::where('slug', 'like', '%' . $this->search . '%')->first() ? Category::where('slug', 'like', '%' . $this->search . '%')->first()->id : '';
        $brand_id = Brand::where('brand_slug', 'like', '%' . $this->search . '%')->first() ? Brand::where('brand_slug', 'like', '%' . $this->search . '%')->first()->id : '';
        $subcategory_id = SubCategory::where('slug', 'like', '%' . $this->search . '%')->first() ? SubCategory::where('slug', 'like', '%' . $this->search . '%')->first()->id : '';
        // dd($category_id);
        $query = Product::whereBetween('sale_price', [$this->min_price, $this->max_price])->where('status', 1);
        if ($category_id) {
            $query = $query->where('category_id', $category_id);
        } elseif ($subcategory_id) {
            $query = $query->where('subcategory_id', $subcategory_id);
        } elseif ($brand_id) {
            $query = $query->where('brand_id', $brand_id);
        } else {
            $query = $query->where('name', 'like', '%' . $this->search . '%')->orwhere('meta_tag', 'like', '%' . $this->search . '%');
        }

        $query = $query->distinct()->select('products.*');
        $products = $query->paginate(20);
        // dd($products);

        $brands = Brand::where('status', 1)->get();
        $categorys = Category::where('status', 1)->get();
        return view('livewire.frontend.search-component', ['categorys' => $categorys, 'products' => $products, 'brands' => $brands])->layout('layouts.main');
    }


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

    public function brandseletc()
    {
        // dd($this->brandtype);
    }
}