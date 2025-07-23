<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Brand;
use App\Models\Breed;
use App\Models\Category;
use App\Models\Product;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use App\Models\Flavour;

class ShopComponent extends Component
{
    use WithPagination;
    public $sorting;
    public $pagesize;
    public $min_price;
    public $max_price;
    public $max, $min;
    public $brandtype = [];
    public $breedtype = [];
    public $discount = [];
    public $wishp = [];
    public $cartp = [];
    public $flavourtype = [];


    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = "10";
        $this->min = Product::where('status', 1)->min('regular_price');
        $this->max = Product::where('status', 1)->max('regular_price');
        $this->min_price = $this->min;
        $this->max_price = $this->max;
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
        // dd($this->pagesize);
        $query = Product::whereHas('activeVendorProducts')
            ->with([
                'bestSeller' => function ($q) {
                    $q->select('id', 'product_id', 'vendor_id', 'price');
                }
            ])
            ->withMin('vendorProducts', 'price')
            ->whereHas('vendorProducts', function ($q) {
                $q->whereBetween('price', [$this->min_price, $this->max_price]);
            })
            ->where('status', 1);
        if ($this->sorting == "date") {
            $query = $query->orderBy('products.created_at', 'DESC');
        }
        if ($this->sorting == "price") {
            $query = $query->orderBy('vendor_products_min_price', 'ASC');
        }
        if ($this->sorting == "price-desc") {
            $query = $query->orderBy('vendor_products_min_price', 'DESC');
        }
        if ($this->brandtype != null) {
            $query = $query->whereIn('brand_id', $this->brandtype);
        }

        //    $query=$query->distinct()->select('products.*',DB::raw('((products.regular_price - products.sale_price)/products.regular_price)*100 as offerdiscount'));
        if ($this->discount != null) {
            //dd($this->discount);
            $query = $query->where('discount_value', '>=', (int) min($this->discount));

        }

        //dd($this->discount);
        $query = $query->distinct()->select('products.*');

        $products = $query->paginate($this->pagesize);
        // dd($products);
        $categorys = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();

        return view('livewire.frontend.shop-component', ['categorys' => $categorys, 'brands' => $brands, 'products' => $products])->layout('layouts.main');
    }


    public function brandseletc()
    {
        // dd($this->brandtype);
    }
    public function breedseletc()
    {
        // dd($this->brandtype);
    }
    public function flavourselect()
    {
        // dd($this->brandtype);
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
                $wishlist->price = $product_price;
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
                'price' => $product_price
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
                $cart->price = $product_price;
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
}