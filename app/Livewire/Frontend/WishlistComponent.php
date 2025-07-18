<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Http\Request;
use Session;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistComponent extends Component
{
    public $qty;

    public function render(Request $request)
    {
        $wishlist = [];
        $count = '';
        if (Auth::check()) {

            $wish = Wishlist::where('user_id', Auth::user()->id)->get();
            // dd($wish);
            $product_ids = $wish->pluck('product_id')->toArray();
            $seller_ids = $wish->pluck('seller_id')->toArray();
            //  dd($seller_ids);
            // $wishlist = Product::whereIn('id', $product_ids)->get();
            $wishlist = Product::whereIn('products.id', $product_ids)
                ->leftJoin('vendor_products', 'products.id', '=', 'vendor_products.product_id')
                ->leftJoin('users', 'vendor_products.vendor_id', '=', 'users.id')
                // ->where(function ($query) use ($seller_ids) {
                //     $query->whereNull('vendor_products.vendor_id')
                //         ->orWhereIn('vendor_products.vendor_id', array_filter($seller_ids));
                // })
                ->select(
                    'products.*',
                    'vendor_products.vendor_id as seller_id',
                    'users.name as seller_name'
                )
                ->get();
                
            $count = Wishlist::where('user_id', Auth::user()->id)->get()->count();
            foreach ($wishlist as $item) {
                $dffg = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $item->id)->first();

                $item['qty'] = $dffg->quantity;
            }

        } else {
            if (Session::has('wishlist')) {
                $wish = $request->session()->get('wishlist');
                $product_ids = array_keys($wish);
                $seller_ids = array_column($wish, 'seller_id');
                // $wishlist = Product::whereIn('id', $product_ids)->get();
                $wishlist = Product::whereIn('products.id', $product_ids)
                    ->leftJoin('vendor_products', 'products.id', '=', 'vendor_products.product_id')
                    ->leftJoin('users', 'vendor_products.vendor_id', '=', 'users.id')
                    ->where(function ($query) use ($seller_ids) {
                        $query->whereNull('vendor_products.vendor_id')
                            ->orWhereIn('vendor_products.vendor_id', array_filter($seller_ids));
                    })
                    ->select(
                        'products.*',
                        'vendor_products.vendor_id as seller_id',
                        'users.name as seller_name'
                    )
                    ->get();
                // dd($wishlist);

                $count = $wishlist->count();
                foreach ($wishlist as $item) {
                    $item['qty'] = $wish[$item->id]['quantity'];
                }
            }
        }
        return view('livewire.frontend.wishlist-component', ['wishlist' => $wishlist, 'count' => $count])->layout('layouts.main');
    }




    public function removeFromWishlist(Request $request, $product_id)
    {
        if (Auth::check()) {
            $wishlist = Wishlist::where('product_id', $product_id)->where('user_id', Auth::user()->id)->first();
            if ($wishlist) {
                $wishlist->delete();
                session()->flash('warning', 'Item remove from Wishlist!');
                //$this->dispatch('wishlist-count-component','refreshComponent');
                $this->dispatch('wishlist_add');
                return;
            }
        } else {
            if (Session::has('wishlist')) {

                $wishlistdf = $request->session()->get('wishlist');
                unset($wishlistdf[$product_id]);
                Session()->put('wishlist', $wishlistdf);

                session()->flash('warning', 'Item remove from Wishlist!');

                $this->dispatch('wishlist_add');
                return;

            }
        }
        return;
    }

    public function EmptyWishlist(Request $request)
    {
        if (Auth::check()) {
            $wishlist = Wishlist::where('user_id', Auth::user()->id)->get();
            if ($wishlist[0]) {
                foreach ($wishlist as $item) {
                    $ewishlist = Wishlist::find($item->id);
                    $ewishlist->delete();
                }

                session()->flash('warning', 'Item remove from Wishlist!');
                // $this->dispatch('wishlist-count-component','refreshComponent');
                $this->dispatch('wishlist_add');
                return;
            }
        } else {
            if (Session::has('wishlist')) {

                Session::forget('wishlist');
                session()->flash('warning', 'Item remove from Wishlist!');
                // $this->dispatch('wishlist-count-component','refreshComponent');
                $this->dispatch('wishlist_add');
                return;

            }
        }
        return;
    }

    public function MoveTOCart(Request $request, $id)
    {
        if (Auth::check()) {
            $wishlist = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $id)->first();
            // dd($wishlist);
            if ($wishlist) {
                $cartcheck = Cart::where('user_id', Auth::user()->id)->where('product_id', $id)->first();
                if (!isset($cartcheck)) {

                    $cart = new Cart();
                    $cart->user_id = Auth::user()->id;
                    $cart->product_id = $wishlist->product_id;
                    $cart->product_name = $wishlist->product_name;
                    $cart->product_image = $wishlist->product_image;
                    $cart->price = $wishlist->price;
                    $cart->quantity = $wishlist->quantity;
                    $cart->save();
                    $wishlist->delete();
                    session()->flash('success', 'Item move to  Cart from Wishlist');
                    $this->dispatch('wishlist_add');
                    $this->dispatch('cart_add');
                    return;
                } else {
                    session()->flash('info', 'Item alreday added to Cart!');
                    return;
                }
            }
        } else {
            if (Session::has('wishlist')) {
                $wishlistdf = $request->session()->get('wishlist');
                if ($wishlistdf[$id]) {
                    $cart = $request->session()->get('cart');
                    if (!isset($cart[$id])) {
                        $ghj = $wishlistdf[$id];
                        $cart[$id] = [
                            'product_id' => $ghj['product_id'],
                            'product_name' => $ghj['product_name'],
                            'product_image' => $ghj['product_image'],
                            'quantity' => $ghj['quantity'],
                            'price' => $ghj['price']
                        ];
                        $request->Session()->put('cart', $cart);
                        unset($wishlistdf[$id]);
                        Session()->put('wishlist', $wishlistdf);
                        session()->flash('success', 'Item move to  Cart from Wishlist');
                        $this->dispatch('wishlist_add');
                        $this->dispatch('cart_add');
                        return;
                    } else {

                        session()->flash('info', 'Item alreday added to Cart!');
                        return;
                    }
                }
                return;

            }
        }
        return;
    }
}