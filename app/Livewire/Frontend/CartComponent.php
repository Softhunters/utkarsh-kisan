<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Http\Request;
use Session;
use App\Models\Wishlist;
use App\Models\SaveForLater;
use App\Models\Tax;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    public $qty;
    public $out_of_stock;
    public $out_of_qty;

    public $haveCouponCode;
    public $CouponCode;
    public $discount;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;
    public $subtotal;
    public $taxvalue;
    public $totalamount;
    public $shippingcost;


    public function render(Request $request)
    {
        // dd($this->CouponCode);
        $cart = [];
        $count = 0;
        $subtotalc = 0;
        $taxtotalc = 0;
        $savelater = [];
        $uploadper = 0;
        $pricesoff = 0;
        $this->discount = 0;
        if (Auth::check()) {
            $cartlsit = Cart::where('user_id', Auth::user()->id)->pluck('product_id')->toArray();
            $cart = Product::whereIn('id', $cartlsit)->get();
            $catlistnumber = Product::whereIn('id', $cartlsit)->pluck('category_id')->toArray();
            $count = Cart::where('user_id', Auth::user()->id)->get()->count();
            $subtotalc = 0;
            $taxtotalc = 0;
            foreach ($cart as $item) {
                $dffg = Cart::where('user_id', Auth::user()->id)->where('product_id', $item->id)->first();
                $item['qty'] = $dffg->quantity;


                $subtotalc = $subtotalc + $item->sale_price * $dffg->quantity;
                $taxtotalc = $taxtotalc + (($item->taxslab->value * $item->sale_price) * ($dffg->quantity) / 100);
                $pricesoff = $pricesoff + (($item->regular_price - $item->sale_price) * ($dffg->quantity));

            }
            // dd($subtotalc,$taxtotalc);
            $this->taxvalue = $taxtotalc;
            $this->subtotal = $subtotalc;
            $this->totalamount = $taxtotalc + $subtotalc;

            $savelater = SaveForLater::where('user_id', Auth::user()->id)->get();

            // dd($pricesoff);
        } else {
            if (Session::has('cart')) {
                $cartlist = $request->session()->get('cart');
                // dd($cartlist);
                $product_ids = array_keys($cartlist);
                $cart = Product::whereIn('id', $product_ids)->get();
                $catlistnumber = Product::whereIn('id', $product_ids)->pluck('category_id')->toArray();
                $count = $cart->count();
                $subtotalc = 0;
                $taxtotalc = 0;

                foreach ($cart as $item) {
                    //dd($cartlist[$item->id]['quantity']);
                    $subtotalc = $subtotalc + $item->sale_price * $cartlist[$item->id]['quantity'];
                    $taxtotalc = $taxtotalc + (($item->taxslab->value * $item->sale_price) * ($cartlist[$item->id]['quantity']) / 100);
                    $item['qty'] = $cartlist[$item->id]['quantity'];
                    $pricesoff = $pricesoff + (($item->regular_price - $item->sale_price) * $cartlist[$item->id]['quantity']);

                }
                $this->taxvalue = $taxtotalc;
                $this->subtotal = $subtotalc;
                $this->totalamount = $taxtotalc + $subtotalc;
                //dd($cart);   
            }
        }

        if ($this->subtotal >= 1000) {
            $this->shippingcost = 0;
        } else {
            $this->shippingcost = 49;
        }

        if (session()->has('coupon')) {
            if ($this->subtotal < session()->get('coupon')['cart_value']) {
                session()->forget('coupon');
            }
            // elseif(count(array_unique($catlistnumber)) > 1)
            // {
            // if(session()->get('coupon')['cat_id']){
            //     session()->forget('coupon');
            //     //$this->removeCoupon();
            //  }
            // }
            else {
                $this->calculateDiscounts();
            }
        }
        if (Auth::check()) {
            $this->setAmountForCheckout();
        }

        return view('livewire.frontend.cart-component', ['cart' => $cart, 'count' => $count, 'subtotalc' => $subtotalc, 'taxtotalc' => $taxtotalc, 'savelater' => $savelater, 'pricesoff' => $pricesoff])->layout('layouts.main');
    }


    public function removeFromCart(Request $request, $product_id)
    {
        if (Auth::check()) {
            $wishlist = Cart::where('product_id', $product_id)->where('user_id', Auth::user()->id)->first();
            if ($wishlist) {
                $wishlist->delete();
                session()->flash('warning', 'Item remove from Cart!');
                // $this->dispatch('wishlist-count-component');
                $this->out_of_stock = '';
                $this->dispatch('cart_add');
                return;
            }
        } else {
            if (Session::has('cart')) {

                $wishlistdf = $request->session()->get('cart');
                unset($wishlistdf[$product_id]);
                Session()->put('cart', $wishlistdf);
                // dd($wishlistdf);
                session()->flash('warning', 'Item remove from Cart!');
                //$this->dispatch('wishlist-count-component');
                $this->out_of_stock = '';
                $this->dispatch('cart_add');
                return;

            }
        }
        return;
    }

    public function EmptyCart(Request $request)
    {
        if (Auth::check()) {
            $wishlist = Cart::where('user_id', Auth::user()->id)->get();
            if ($wishlist[0]) {
                foreach ($wishlist as $item) {
                    $ewishlist = Cart::find($item->id);
                    $ewishlist->delete();
                }

                session()->flash('warning', 'Items remove from Cart!');
                //  $this->dispatch('wishlist-count-component','refreshComponent');
                $this->dispatch('cart_add');
                return;
            }
        } else {
            if (Session::has('cart')) {

                Session::forget('cart');
                session()->flash('warning', 'Items remove from Cart!');
                // $this->dispatch('wishlist-count-component','refreshComponent');
                $this->dispatch('cart_add');
                return;

            }
        }
        return;
    }


    public function Savetolater($id)
    {
        if (Auth::check()) {
            $wishlist = Cart::where('user_id', Auth::user()->id)->where('product_id', $id)->first();
            if ($wishlist) {
                $cart = new SaveForLater();
                $cart->user_id = Auth::user()->id;
                $cart->product_id = $wishlist->product_id;
                $cart->save();

                $wishlist->delete();

                session()->flash('success', 'Item move to SaveForlater from Cart!');
                // $this->dispatch('wishlist-count-component','refreshComponent');
                $this->dispatch('cart_add');
                return;
            }
            return;
        }
        return;
    }


    public function removeFromsavelater($id)
    {
        $savelater = SaveForLater::find($id);
        $savelater->delete();
        session()->flash('success', 'Item remove  from SaveForlater!');
        // $this->dispatch('wishlist-count-component','refreshComponent');
        return;

    }

    public function MovetoCart($id)
    {
        if (Auth::check()) {
            $savelater = SaveForLater::find($id);
            if ($savelater) {

                $cartcheck = Cart::where('user_id', Auth::user()->id)->where('product_id', $savelater->product_id)->first();
                if (!isset($cartcheck)) {
                    $product = Product::where('id', $savelater->product_id)->first();
                    $cart = new Cart();
                    $cart->user_id = Auth::user()->id;
                    $cart->product_id = $product->id;
                    $cart->product_name = $product->name;
                    $cart->product_image = $product->image;
                    $cart->price = $product->sale_price;
                    $cart->quantity = 1;
                    $cart->save();
                    $savelater->delete();
                    session()->flash('success', 'Item added to cartlist!');
                    // $this->dispatch('wishlist-count-component','refreshComponent');
                    $this->dispatch('cart_add');
                    return;
                } else {
                    session()->flash('info', 'Item alreday added to Cartlist!');
                    return;
                }
            }
        }
    }


    public function increaseQuantity(Request $request, $id)
    {
        // dd($id);
        if (Auth::check()) {
            $wishlist = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->first();
            if ($wishlist) {
                if ($wishlist->quantity < 20) {
                    $wishlist->quantity = $wishlist->quantity + 1;
                }
                $wishlist->save();
                //session()->flash('message','product remove from Cart');
                //$this->dispatch('wishlist-count-component','refreshComponent');
                $this->dispatch('cart_add');
                return;
            }
        } else {
            if (Session::has('cart')) {

                $cart = $request->session()->get('cart');
                $asdf = $cart[$id];
                if ($asdf['quantity'] < 20) {
                    $cart[$id]['quantity'] = $asdf['quantity'] + 1;
                }
                Session()->put('cart', $cart);
                $wishlistdfdf = $request->session()->get('cart');
                //dd($wishlistdfdf);
                //  session()->flash('message','product remove from cart');
                //  $this->dispatch('wishlist-count-component','refreshComponent');
                $this->dispatch('cart_add');
                return;

            }
        }
        return;
    }
    public function decreaseQuantity(Request $request, $id)
    {
        // dd($id);
        if (Auth::check()) {
            $wishlist = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->first();
            if ($wishlist) {
                if ($wishlist->quantity == '1') {
                    $wishlist->delete();
                } else {
                    $wishlist->quantity = $wishlist->quantity - 1;
                    $wishlist->save();
                    //session()->flash('message','product remove from Cart');
                    //$this->dispatch('wishlist-count-component','refreshComponent');

                }
                $this->dispatch('cart_add');
                return;
            }
        } else {
            if (Session::has('cart')) {

                $cart = $request->session()->get('cart');
                $asdf = $cart[$id];
                if ($cart[$id]['quantity'] == 1) {

                    unset($cart[$id]);

                } else {
                    $cart[$id]['quantity'] = $asdf['quantity'] - 1;


                }
                Session()->put('cart', $cart);

                //dd($wishlistdfdf);
                // session()->flash('message','product remove from cart');
                // $this->dispatch('wishlist-count-component','refreshComponent');
                $this->dispatch('cart_add');
                return;

            }
        }
        return;
    }

    public function checkout()
    {
        if (Auth::check()) { //dd($this->out_of_stock, $this->out_of_qty);
            if ($this->out_of_stock) {
                session()->flash('info', 'Remove Out Of stock Product please!');
                return;
            }
            if ($this->out_of_qty) {
                session()->flash('info', 'Cart Qunatity is out of stock please! change qunatity');
                return;
            }
            return redirect()->route('check-out');
        } else {
            session()->flash('cmessage', 'Login First');
            $this->dispatch('show-edit-post-modal');
            return;
        }
    }

    public function setAmountForCheckout()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        if (!$carts->count() > 0) {
            session()->forget('checkout');
            return;
        }

        if (session()->has('coupon')) {
            session()->put('checkout', [
                'discount' => $this->discount,
                'subtotal' => $this->subtotalAfterDiscount,
                'tax' => $this->taxAfterDiscount,
                'total' => $this->totalAfterDiscount,
                'shipping' => $this->shippingcost,
                'item' => $carts->count(),
            ]);
        } else {
            session()->put('checkout', [
                'discount' => 0,
                'subtotal' => $this->subtotal,
                'tax' => $this->taxvalue,
                'total' => $this->totalamount,
                'shipping' => $this->shippingcost,
                'item' => $carts->count(),
            ]);

            // $this->taxvalue = $taxtotal;
            // $this->subtotal = $subtotal;
            // $this->totalamount = $taxtotal + $subtotal;
        }
    }

    public function applyCouponCode(Request $request)
    {
        $this->validate([
            'CouponCode' => 'required',
        ]);

        $coupon = Coupon::where('code', $this->CouponCode)->where('status', 1)->first();
        if (!$coupon) {
            session()->flash('coupon_message', 'Coupon code is invalid');
            return;
        }
        //category code
        if ($coupon->category_id != '') {
            if (Auth::check()) {
                $catlist = Cart::where('user_id', Auth::user()->id)->pluck('product_id')->toArray();
                $cat = Product::whereIn('id', $catlist)->pluck('category_id')->toArray();

            } else {
                if (Session::has('cart')) {
                    $cartlist = $request->session()->get('cart');

                    $catf = array_keys($cartlist);
                    $cat = Product::whereIn('id', $catf)->pluck('category_id')->toArray();

                }

            }
            // dd($cat);
            $cat = array_unique($cat);
            if (count($cat) == 1) {
                // $cat_id = array_unique($cat);
                if ($cat[0] == $coupon->category_id) {
                    //with cart value
                    if ($coupon->cart_value != '') {
                        if ($coupon->cart_value <= $this->subtotal) {
                            session()->put('coupon', [
                                'code' => $coupon->code,
                                'type' => $coupon->type,
                                'value' => $coupon->value,
                                'cat_id' => $coupon->category_id,
                                'cart_value' => $coupon->cart_value
                            ]);
                        } else {
                            session()->flash('coupon_message', 'Coupon code is Valid But Cart ammount is less');
                            return;
                        }
                    } else {
                        session()->put('coupon', [
                            'code' => $coupon->code,
                            'type' => $coupon->type,
                            'value' => $coupon->value,
                            'cat_id' => $coupon->category_id,
                            'cart_value' => $coupon->cart_value
                        ]);
                    }

                } else {
                    session()->flash('coupon_message', 'Coupon code is Valid but Other Category product added!');
                    return;
                }
            } else {
                session()->flash('coupon_message', 'Coupon code is Valid but Other Category product added!');
                return;
            }

        }

        if ($coupon->brand_id != '') {
            if (Auth::check()) {
                $catlist = Cart::where('user_id', Auth::user()->id)->pluck('product_id')->toArray();
                $bat = Product::whereIn('id', $catlist)->pluck('brand_id')->toArray();

            } else {
                if (Session::has('cart')) {
                    $cartlist = $request->session()->get('cart');

                    $catf = array_keys($cartlist);
                    $bat = Product::whereIn('id', $catf)->pluck('brand_id')->toArray();

                }

            }
            // dd($cat);
            $bat = array_unique($bat);
            if (count($bat) == 1) {
                // $cat_id = array_unique($cat);
                if ($bat[0] == $coupon->brand_id) {
                    //with cart value
                    if ($coupon->cart_value != '') {
                        if ($coupon->cart_value <= $this->subtotal) {
                            session()->put('coupon', [
                                'code' => $coupon->code,
                                'type' => $coupon->type,
                                'value' => $coupon->value,
                                'cat_id' => $coupon->category_id,
                                'cart_value' => $coupon->cart_value
                            ]);
                        } else {
                            session()->flash('coupon_message', 'Coupon code is Valid But Cart ammount is less');
                            return;
                        }
                    } else {
                        session()->put('coupon', [
                            'code' => $coupon->code,
                            'type' => $coupon->type,
                            'value' => $coupon->value,
                            'cat_id' => $coupon->category_id,
                            'cart_value' => $coupon->cart_value
                        ]);
                    }

                } else {
                    session()->flash('coupon_message', 'Coupon code is Valid but Other Brand product added!');
                    return;
                }
            } else {
                session()->flash('coupon_message', 'Coupon code is Valid but Other Brand product added!');
                return;
            }
        }
        //only cart value
        if ($coupon->cart_value != '') {
            if ($coupon->cart_value <= $this->subtotal) {
                session()->put('coupon', [
                    'code' => $coupon->code,
                    'type' => $coupon->type,
                    'value' => $coupon->value,
                    'cat_id' => $coupon->category_id,
                    'cart_value' => $coupon->cart_value
                ]);

            } else {
                session()->flash('coupon_message', 'Coupon code is Valid But Cart ammount is less');
                return;
            }

        }
        //flat discount
// dd('sf');
        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cat_id' => $coupon->category_id,
            'cart_value' => $coupon->cart_value
        ]);


    }
    public function calculateDiscounts()
    {
        if (session()->has('coupon')) {
            if (session()->get('coupon')['type'] == '2') {
                $this->discount = session()->get('coupon')['value'];
            } else {
                $this->discount = ($this->subtotal * session()->get('coupon')['value']) / 100;
            }
            $this->subtotalAfterDiscount = $this->subtotal - $this->discount;
            $this->taxAfterDiscount = $this->taxvalue;
            $this->totalAfterDiscount = $this->subtotalAfterDiscount + $this->taxAfterDiscount;
            $this->CouponCode = session()->get('coupon')['code'];
        }
    }

    public function removeCoupon()
    {
        // dd('dfgh');
        session()->forget('coupon');
        $this->CouponCode = '';
        $this->discount = '';
        return;
    }
    public function prcheckout()
    {
        if (Auth::check()) { //dd($this->out_of_stock, $this->out_of_qty);
            if ($this->out_of_stock) {
                session()->flash('message', 'Remove Out Of stock Product please!');
                return;
            }
            if ($this->out_of_qty) {
                session()->flash('message', 'Cart Qunatity is out of stock please! change qunatity');
                return;
            }
            return redirect()->route('prcheck-out');
        } else {
            session()->flash('warning', 'Login First');
            $this->dispatch('show-edit-post-modal');
            return;
        }
    }

    public function EmptySaveforlater()
    {
        $wishlist = SaveForLater::where('user_id', Auth::user()->id)->get();
        if ($wishlist[0]) {
            foreach ($wishlist as $item) {
                $ewishlist = SaveForLater::find($item->id);
                $ewishlist->delete();
            }

            session()->flash('warning', 'Items remove from SaveForlater');
            //  $this->dispatch('wishlist-count-component','refreshComponent');
            $this->dispatch('cart_add');
            return;
        }
    }
}