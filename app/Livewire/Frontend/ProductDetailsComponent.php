<?php

namespace App\Livewire\Frontend;

use App\Models\VendorProduct;
use Livewire\Component;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Http\Request;
use Session;
use App\Models\review;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use App\Models\Question;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class ProductDetailsComponent extends Component
{
    use WithFileUploads;
    public $slug;
    public $vendor_id;
    public $quntiti;
    // public $wish;
    public $rimages;
    public $rate;
    public $message;
    public $question;
    // public $cart;
    public $reviewyes;
    public $variant_id;
    public $wishp = [];
    public $cartp = [];

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->quntiti = 1;
    }
    public function storeReview($id)
    {
        if (!Auth::check()) {

            return redirect('ulogin');
        } else {
            // dd($this->rate);
            $this->validate([
                'message' => 'required',
                'rate' => 'required',
                'rimages' => 'required',
            ]);
            $review = new review();
            $review->product_id = $id;
            $review->user_id = Auth::user()->id;
            $review->message = $this->message;
            $review->rating = $this->rate;
            if ($this->rimages) {
                $imagesname = '';
                foreach ($this->rimages as $key => $image) {
                    $imgName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                    $image->storeAs('review', $imgName);
                    $imagesname = $imagesname . ',' . $imgName;
                }
                // dd($imagesname);
                $review->images = $imagesname;
            }
            $review->save();
            Session()->flash('message', 'Review has been Submited Successfully');
        }
    }
    public function storeQuestion($id)
    {
        if (!Auth::check()) {
            return redirect('ulogin');
        } else {
            $this->validate([
                'question' => 'required',
            ]);
            $question = new Question();
            $question->product_id = $id;
            $question->quser_id = Auth::user()->id;
            $question->question = $this->question;
            $question->save();
            Session()->flash('message', 'Question has been Submited Successfully');
        }
    }

    public function addToWishlist(Request $request, $product_id, $product_price, $seller_id = null)
    {
        $id = $product_id;
        if (Auth::check()) {
            $wproduct = Wishlist::where('product_id', $product_id)->where('user_id', Auth::user()->id)->where('seller_id', $seller_id)->first();

            if ($wproduct) {
                session()->flash('info', 'Item alreday in wishlist!');
                return;
            } else {
                $product = Product::where('id', $product_id)->first();
                $wishlist = new Wishlist();
                $wishlist->user_id = Auth::user()->id;
                $wishlist->product_id = $product_id;
                $wishlist->product_name = $product->name;
                $wishlist->product_image = $product->image;
                $wishlist->seller_id = $seller_id;
                $wishlist->price = $product_price;
                $wishlist->quantity = $this->quntiti;
                $wishlist->save();
                session()->flash('success', 'Item added to wishlist!');
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
                'quantity' => $this->quntiti,
                'seller_id' => $seller_id,
                'price' => $product_price
            ];
            Session()->put('wishlist', $wishlist);

            session()->flash('success', 'Item added to wishlist!');
            $this->dispatch('wishlist_add');

        }

        //  $this->dispatch('wishlist-count-component','refreshComponent');
        return;
    }

    public function removeFromWishlist(Request $request, $product_id)
    {
        if (Auth::check()) {
            $wishlist = Wishlist::where('product_id', $product_id)->where('user_id', Auth::user()->id)->first();
            if ($wishlist) {
                $wishlist->delete();
                session()->flash('warning', 'Item remove from wishlist!');
                // $this->dispatch('wishlist-count-component','refreshComponent');
                $this->wish = '';
                $this->dispatch('wishlist_add');
                return;
            }
        } else {
            if (Session::has('wishlist')) {

                $wishlistdf = $request->session()->get('wishlist');
                unset($wishlistdf[$product_id]);
                Session()->put('wishlist', $wishlistdf);
                // dd($wishlistdf);
                session()->flash('warning', 'Item remove from wishlist!');
                // $this->dispatch('wishlist-count-component','refreshComponent');
                $this->wish = '';
                $this->dispatch('wishlist_add');
                return;

            }
        }
        // return;
    }
    public function AddtoCart(Request $request, $product_id, $product_price, $seller_id = null)
    {
        $id = $product_id;
        // dd($id);
        if (Auth::check()) {
            $wproduct = Cart::where('product_id', $product_id)->where('user_id', Auth::user()->id)->where('seller_id', $seller_id)->first();
            // dd($wproduct);
            if ($wproduct) {
                session()->flash('info', 'Item alreday in Cart');
                return;
            } else {
                $product = Product::where('id', $product_id)->first();

                $cart = new Cart();
                $cart->user_id = Auth::user()->id;
                $cart->product_id = $product_id;
                $cart->product_name = $product->name;
                $cart->product_image = $product->image;
                $cart->price = $product_price;
                $cart->quantity = $this->quntiti;
                $cart->seller_id = $seller_id;
                $cart->save();
                session()->flash('success', 'Item added to cart!');
                // $this->dispatch('wishlist-count-component','refreshComponent');
                $this->dispatch('cart_add');
                // dd('gkj');
                return;

            }
        } else {
            $product = Product::where('id', $product_id)->first();
            $cart = $request->session()->get('cart');
            $cart[$id] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_image' => $product->image,
                'quantity' => $this->quntiti,
                'price' => $product_price,
                'seller_id' => $seller_id
            ];
            Session()->put('cart', $cart);
            session()->flash('success', 'Item added to cart!');
            $this->dispatch('cart_add');
        }

        //  $this->dispatch('wishlist-count-component','refreshComponent');
        return;
    }
    public function render(Request $request)
    {
        if ($this->variant_id) {
            $product = Product::with([
                'seller',
                'bestSeller' => function ($q) {
                    $q->select('id', 'product_id', 'vendor_id', 'price');
                }
            ])
                ->where('id', $this->variant_id)
                ->first();
        } else {
            $product = Product::with([
                'seller',
            ])
                ->where('slug', $this->slug)
                ->first();
        }

        $discount = round((($product->regular_price - $product->seller?->price) / $product->regular_price) * 100, 2);
        $discount = max($discount, 0);

        $product->discount_value = (string) $discount;


        $varaiants = Product::with([
            'seller',
            'bestSeller' => function ($q) {
                $q->select('id', 'product_id', 'vendor_id', 'price');
            }
        ])
            ->where(function ($query) use ($product) {
                $query->where('parent_id', $product->parent_id ?: $product->id)
                    ->orWhere('id', $product->parent_id ?: $product->id);
            })
            ->whereHas('bestSeller')
            ->get();


        $otherVendors = VendorProduct::where('product_id', $product->id)->whereNot('vendor_id', $this->vendor_id)->where('status', 1)->get();

        if (Auth::check()) {
            $this->cartp = Cart::where('user_id', Auth::user()->id)->pluck('product_id')->toArray();
            $this->wishp = Wishlist::where('user_id', Auth::user()->id)->pluck('product_id')->toArray();
            // $ord = OrderItem::leftJoin('orders', 'orders.id', 'orderitems.order_id')->where('orderitems.product_id', $product->id)->where('orders.user_id', Auth::user()->id)->where('orders.status', 'delivered')->first();
            if (isset($ord)) {
                $this->reviewyes = '1';
            }
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

        $shareButtons = \Share::page(route('product-details', ['slug' => $product->slug]))->facebook()->twitter()->linkedin()->telegram()->whatsapp()->reddit();
        $popular_products = Product::whereHas('activeVendorProducts')
            ->with([
                'bestSeller' => function ($q) {
                    $q->select('id', 'product_id', 'vendor_id', 'price');
                }
            ])
            ->where('status', 1)
            ->inRandomOrder()
            ->limit(8)
            ->get()
            ->map(function ($product) {
                $discount = round((($product->regular_price - $product->seller->price) / $product->regular_price) * 100, 2);
                $discount = max($discount, 0);

                $product->discount_value = (string) $discount;
                return $product;
            });

        $related_products = Product::whereHas('activeVendorProducts')
            ->with([
                'bestSeller' => function ($q) {
                    $q->select('id', 'product_id', 'vendor_id', 'price');
                }
            ])
            ->where('category_id', $product->category_id)
            ->where('status', 1)
            ->inRandomOrder()
            ->limit(8)
            ->get()
            ->map(function ($product) {
                $discount = round((($product->regular_price - $product->seller->price) / $product->regular_price) * 100, 2);
                $discount = max($discount, 0);

                $product->discount_value = (string) $discount;
                return $product;
            });
        return view('livewire.frontend.product-details-component', ['otherVendors' => $otherVendors, 'product' => $product, 'shareButtons' => $shareButtons, 'varaiants' => $varaiants, 'popular_products' => $popular_products, 'related_products' => $related_products])->layout('layouts.main');
    }

    public function checkout(Request $request, $id, $sale_price)
    {
        if (!Auth::check()) {
            $this->dispatch('show-edit-post-modal');
            return;
        } else {
            $this->AddtoCart($request, $id, $sale_price);
            return $this->redirect('/cart');
        }
    }
    public function changeparameter($id)
    {
        // dd($id);
        $this->variant_id = $id;
        return;
    }

    public function FAddtoCart(Request $request, $product_id, $product_price, $seller_id = null)
    {
        $id = $product_id;
        if (Auth::check()) {
            //dd('gfgf');
            $wproduct = Cart::where('product_id', $product_id)->where('user_id', Auth::user()->id)->where('seller_id', $seller_id)->first();
            if ($wproduct) {

                session()->flash('info', 'Item alreday added to Cart');
                return;
            } else {
                $product = Product::where('id', $product_id)->first();

                $cart = new Cart();
                $cart->user_id = Auth::user()->id;
                $cart->product_id = $product_id;
                $cart->product_name = $product->name;
                $cart->product_image = $product->image;
                $cart->price = $product_price;
                $cart->seller_id = $seller_id;
                $cart->quantity = '1';
                $cart->save();
                session()->flash('success', 'Item added to Cart!');
                // $this->dispatch('wishlist-count-component','refreshComponent');
                $this->dispatch('cart_add');
                return;

            }
        } else {
            $product = Product::where('id', $product_id)->first();
            $cart = $request->session()->get('cart');


            $cart[$id] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_image' => $product->image,
                $cart->seller_id = $seller_id,
                'quantity' => '1',
                'price' => $product_price
            ];
            Session()->put('cart', $cart);

            session()->flash('success', 'Item added to Cart!');

            $this->dispatch('cart_add');
        }

        return;
    }
    public function FaddToWishlist(Request $request, $product_id, $product_price, $seller_id = null)
    {
        $id = $product_id;
        if (Auth::check()) {
            $wproduct = Wishlist::where('product_id', $product_id)->where('user_id', Auth::user()->id)->where('seller_id', $seller_id)->first();
            if ($wproduct) {
                session()->flash('info', 'Item alreday in wishlist!');
                return;
            } else {
                $product = Product::where('id', $product_id)->first();
                $wishlist = new Wishlist();
                $wishlist->user_id = Auth::user()->id;
                $wishlist->product_id = $product_id;
                $wishlist->product_name = $product->name;
                $wishlist->product_image = $product->image;
                $wishlist->price = $product_price;
                $wishlist->seller_id = $seller_id;
                $wishlist->quantity = '1';
                $wishlist->save();
                session()->flash('success', 'Item added to wishlist!');
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

            session()->flash('success', 'Item Added to wishlist!');
            $this->dispatch('wishlist_add');

        }
        return;
    }
}