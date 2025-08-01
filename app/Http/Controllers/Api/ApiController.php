<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VendorProduct;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Slider;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Testimonial;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\ShippingAddress;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Models\review;
use Livewire\WithFileUploads;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use App\Models\Websetting;
use App\Models\RewardPonitSetting;
use App\Models\WalletTransaction;
use App\Models\RewardTransaction;


class ApiController extends Controller
{
    public function home(Request $request)
    {

        $result['sliders'] = Slider::where('for', 'home')->where('status', 1)->get();
        $result['categorys'] = Category::where('status', '1')->where('is_home', '1')->get();
        $result['subcategorys'] = SubCategory::leftJoin('categories', 'categories.id', 'sub_categories.category_id')->select('sub_categories.*', 'categories.slug as cname')->where('sub_categories.is_home', 1)->where('sub_categories.status', 1)->get();
        $result['brands'] = Brand::where('is_home', 1)->where('status', 1)->get();
        $result['banners'] = Banner::where('status', 1)->where('for', 'home')->get();
        $result['cbanners'] = Banner::where('status', 1)->where('for', '1')->get();

        // $result['sum'] = Product::withAvg('reviews', 'rating')->get();
        $result['testimonials'] = Testimonial::where('status', 1)->get();

        if (auth('sanctum')->user()) {
            $result['products'] = Product::whereHas('activeVendorProducts')
                ->whereHas('category', function ($q) {
                    $q->where('status', 1);
                })
                ->whereHas('subCategories', function ($q) {
                    $q->where('status', 1);
                })
                ->where('sale_price', '>', 0)
                ->where('status', operator: 1)->inRandomOrder()
                ->with(['brands', 'seller'])
                ->withAvg('wishlist', 'user_id')
                ->withAvg('cart', 'user_id')
                ->withAvg('reviews', 'rating')
                ->withCount('reviews')->get()->take(8)
                ->map(function ($product) {
                    $discount = round((($product->regular_price - $product->seller->price) / $product->regular_price) * 100, 2);
                    $discount = max($discount, 0);

                    $product->discount_value = (string) $discount;
                    $product->sale_price = str($product->seller->price);
                    $product->stock_status = str($product->seller->stock_status);
                    return $product;
                });
            ;
            $result['fproducts'] = Product::whereHas('activeVendorProducts')
                ->whereHas('category', function ($q) {
                    $q->where('status', 1);
                })
                ->whereHas('subCategories', function ($q) {
                    $q->where('status', 1);
                })
                ->with('seller')->where('featured', 1)->where('status', 1)->inRandomOrder()->with(['brands'])->withAvg('wishlist', 'user_id')->withAvg('cart', 'user_id')->withAvg('reviews', 'rating')->withCount('reviews')->get()->take(8)
                ->map(function ($product) {
                    $discount = round((($product->regular_price - $product->seller->price) / $product->regular_price) * 100, 2);
                    $discount = max($discount, 0);
                    $product->discount_value = (string) $discount;
                    $product->sale_price = str($product->seller->price);
                    $product->stock_status = str($product->seller->stock_status);
                    return $product;
                });
        } else {
            $result['products'] = Product::whereHas('activeVendorProducts')
                ->whereHas('category', function ($q) {
                    $q->where('status', 1);
                })
                ->whereHas('subCategories', function ($q) {
                    $q->where('status', 1);
                })
                ->with('seller')->where('sale_price', '>', 0)->where('status', 1)->inRandomOrder()->with(['brands'])->withAvg('reviews', 'rating')->withCount('reviews')->get()->take(8)
                ->map(function ($product) {
                    $discount = round((($product->regular_price - $product->seller->price) / $product->regular_price) * 100, 2);
                    $discount = max($discount, 0);
                    $product->discount_value = (string) $discount;
                    $product->sale_price = str($product->seller->price);
                    $product->stock_status = str($product->seller->stock_status);
                    return $product;
                });
            ;
            $result['fproducts'] = Product::whereHas('activeVendorProducts')
                ->whereHas('category', function ($q) {
                    $q->where('status', 1);
                })
                ->whereHas('subCategories', function ($q) {
                    $q->where('status', 1);
                })
                ->with('seller')->where('featured', 1)->where('status', 1)->inRandomOrder()->with(['brands'])->withAvg('reviews', 'rating')->withCount('reviews')->get()->take(8)
                ->map(function ($product) {
                    $discount = round((($product->regular_price - $product->seller->price) / $product->regular_price) * 100, 2);
                    $discount = max($discount, 0);
                    $product->discount_value = (string) $discount;
                    $product->sale_price = str($product->seller->price);
                    $product->stock_status = str($product->seller->stock_status);
                    return $product;
                });
        }

        return response()->json([
            'status' => true,
            'result' => $result
        ], 200);
    }

    public function CategoryData(Request $request)
    {
        $per_page = 10;
        $mip = Product::where('status', 1)->min('regular_price');
        $map = Product::where('status', 1)->max('regular_price');
        if ($request->has('per_page'))
            $per_page = $request->per_page;
        if ($request->has('mip'))
            $mip = $request->mip;
        if ($request->has('map'))
            $map = $request->map;


        $result['category'] = Category::where('slug', $request->id)->first();
        $result['subcategorys'] = SubCategory::where('category_id', $result['category']->id)->get();
        if (isset($request->sid)) {
            $result['subcategory'] = SubCategory::where('slug', $request->sid)->first();
            $result['scbanners'] = Banner::where('status', 1)->where('for', $result['subcategory']->id)->get();
            if (auth('sanctum')->user()) {
                $query = Product::whereHas('activeVendorProducts')
                    ->whereHas('category', function ($q) {
                        $q->where('status', 1);
                    })
                    ->whereHas('subCategories', function ($q) {
                        $q->where('status', 1);
                    })->whereBetween('regular_price', [$mip, $map])->where('category_id', $result['category']->id)->where('subcategory_id', $result['subcategory']->id)->with(['reviews', 'brands'])->withAvg('reviews', 'rating')->withAvg('wishlist', 'user_id')->withAvg('cart', 'user_id')->where('status', 1);
            } else {
                $query = Product::whereHas('activeVendorProducts')
                    ->whereHas('category', function ($q) {
                        $q->where('status', 1);
                    })
                    ->whereHas('subCategories', function ($q) {
                        $q->where('status', 1);
                    })->whereBetween('regular_price', [$mip, $map])->where('category_id', $result['category']->id)->where('subcategory_id', $result['subcategory']->id)->with(['reviews', 'brands'])->withAvg('reviews', 'rating')->where('status', 1);
            }
        } else {
            $result['cbanners'] = Banner::where('status', 1)->where('for', $result['category']->id)->get();

            $query = Product::whereHas('activeVendorProducts')
                ->whereHas('category', function ($q) {
                    $q->where('status', 1);
                })
                ->whereHas('subCategories', function ($q) {
                    $q->where('status', 1);
                })->whereBetween('regular_price', [$mip, $map])->where('category_id', $result['category']->id)->where('status', 1);

        }

        if ($request->sorting == "date") {
            $query = $query->orderBy('products.created_at', 'DESC');
        }
        if ($request->sorting == "price") {
            $query = $query->orderBy('regular_price', 'ASC');
        }
        if ($request->sorting == "price-desc") {
            $query = $query->orderBy('regular_price', 'DESC');
        }
        if ($request->brandtype != null) {
            $query = $query->whereIn('brand_id', $request->brandtype);
        }
        if ($request->discount != null) {
            $query = $query->where('discount_value', '>', max($request->discount));
        }

        if (auth('sanctum')->user()) {
            $query = $query->distinct()->select('products.*')->with(['brands', 'seller'])->withAvg('reviews', 'rating')->withAvg('wishlist', 'user_id')->withAvg('cart', 'user_id')->withCount('reviews');
        } else {
            $query = $query->distinct()->select('products.*')->with(['brands', 'seller'])->withAvg('reviews', 'rating')->withCount('reviews');
        }

        $result['products'] = $query->paginate($per_page);

        $result['products']->setCollection(
            $result['products']->getCollection()->map(function ($product) {
                $discount = 0;
                if ($product->regular_price > 0 && isset($product->seller->price)) {
                    $discount = round((($product->regular_price - $product->seller->price) / $product->regular_price) * 100, 2);
                    $discount = max($discount, 0);
                }

                $product->discount_value = (string) $discount;
                $product->sale_price = str($product->seller->price ?? 0);
                return $product;
            })
        );

        return response()->json([
            'status' => true,
            'result' => $result
        ], 200);
    }

    public function ProductData(Request $request)
    {
        $userl = auth('sanctum')->user();

        if ($userl) {
            $result['product'] = Product::where('slug', $request->id)->with(['questions', 'category', 'subCategories', 'brands', 'seller'])->withAvg('reviews', 'rating')->withAvg('wishlist', 'user_id')->withAvg('cart', 'user_id')->first();
        } else {
            $result['product'] = Product::where('slug', $request->id)->with(['questions', 'category', 'subCategories', 'brands', 'seller'])->withAvg('reviews', 'rating')->first();
        }
        if ($result['product']) {
            $discount = round((($result['product']->regular_price - $result['product']->seller->price) / $result['product']->regular_price) * 100, 2);
            $discount = max($discount, 0);

            $result['product']->discount_value = (string) $discount;
            $result['product']->stock_status = $result['product']->seller->stock_status;
            $result['product']->sale_price = str($result['product']->seller->price);
        }
        if ($result['product']->parent_id) {
            $result['varaiants'] = Product::where('parent_id', $result['product']->parent_id)->orWhere('id', $result['product']->parent_id)->select('products.id', 'products.variant_detail', 'products.regular_price', 'products.sale_price', 'products.slug')->get();
        } else {
            $result['varaiants'] = Product::where('parent_id', $result['product']->id)->orWhere('id', $result['product']->id)->select('products.id', 'products.variant_detail', 'products.regular_price', 'products.sale_price', 'products.slug')->get();
        }
        $result['shareButtons'] = \Share::page(route('product-details', ['slug' => $result['product']->slug]))->facebook()->twitter()->linkedin()->telegram()->whatsapp()->reddit();
        $result['reviews'] = review::where('product_id', $result['product']->id)->with(['user'])->get();
        $result['seller_list'] = VendorProduct::leftJoin('users', 'vendor_products.vendor_id', '=', 'users.id')
            ->where('vendor_products.product_id', $result['product']->id)
            ->whereNot('vendor_products.vendor_id', $result['product']->seller->vendor_id ?? 1)
            ->select('vendor_products.*', 'users.name as seller_name')
            ->get();
        $result['seller_cart_list'] = Cart::where('product_id', $result['product']->id)
            ->where('user_id', auth('sanctum')->user()->id)
            ->select('seller_id')->get();
        return response()->json([
            'status' => true,
            'result' => $result

        ], 200);
    }


    public function BrandData(Request $request)
    {
        $result['brands'] = Brand::where('status', '!=', 3)->get();
        return response()->json([
            'status' => true,
            'result' => $result
        ], 200);

    }
    public function BrandDetail(Request $request)
    {
        $per_page = 10;
        $mip = Product::where('status', 1)->min('regular_price');
        $map = Product::where('status', 1)->max('regular_price');
        if ($request->has('per_page'))
            $per_page = $request->per_page;
        if ($request->has('mip'))
            $mip = $request->mip;
        if ($request->has('map'))
            $map = $request->map;

        $result['brand'] = Brand::where('brand_slug', $request->brand_slug)->first();

        $query = Product::whereHas('activeVendorProducts')
            ->whereHas('category', function ($q) {
                $q->where('status', 1);
            })
            ->whereHas('subCategories', function ($q) {
                $q->where('status', 1);
            })->where('brand_id', $result['brand']->id)->whereBetween('regular_price', [$mip, $map])->where('status', 1);

        if ($request->sorting == "date") {
            $query = $query->orderBy('products.created_at', 'DESC');
        }
        if ($request->sorting == "price") {
            $query = $query->orderBy('regular_price', 'ASC');
        }
        if ($request->sorting == "price-desc") {
            $query = $query->orderBy('regular_price', 'DESC');
        }
        // if($request->brandtype != null)
        // {
        //     $query=$query->whereIn('brand_id',$request->brandtype);
        // }
        if ($request->breedtype != null) {
            $query = $query->whereIn('breed_id', $request->breedtype);
        }
        if ($request->flavourtype != null) {
            $query = $query->whereIn('flavour_id', $request->flavourtype);
        }
        if ($request->discount != null) {
            $query = $query->where('discount_value', '>', max($request->discount));
        }

        $query = $query->distinct()->select('products.*');

        if (auth('sanctum')->user()) {
            $result['products'] = $query->withAvg('reviews', 'rating')->withAvg('wishlist', 'user_id')->withAvg('cart', 'user_id')->withCount('reviews')->with(['brands', 'seller'])->paginate($per_page);
        } else {
            $result['products'] = $query->withAvg('reviews', 'rating')->withCount('reviews')->with(['brands', 'seller'])->paginate($per_page);
        }

        $result['products']->setCollection(
            $result['products']->getCollection()->map(function ($product) {
                $discount = 0;
                if ($product->regular_price > 0 && isset($product->seller->price)) {
                    $discount = round((($product->regular_price - $product->seller->price) / $product->regular_price) * 100, 2);
                    $discount = max($discount, 0);
                }

                $product->discount_value = (string) $discount;
                $product->sale_price = str($product->seller->price ?? 0);
                $product->stock_status = str($product->seller->stock_status);
                return $product;
            })
        );

        return response()->json([
            'status' => true,
            'result' => $result
        ], 200);

    }
    public function Addwishlist(Request $request)
    {
        $uwish = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->id)
            ->where('seller_id', $request->sid)->first();
        if (isset($uwish)) {
            $wish = Wishlist::find($uwish->id);
            $wish->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Product remove from wishlist successfully!',
                // 'result' => $result
            ], 200);
        }
        // $product = Product::where('id', $request->id)->first();
        $product = Product::where('products.id', $request->id)
            ->join('vendor_products', 'vendor_products.product_id', '=', 'products.id')
            ->where('vendor_products.vendor_id', $request->sid)
            ->select('products.*', 'vendor_products.price as sale_price')
            ->first();
        // dd($product);
        if (isset($product)) {
            $wish = new Wishlist();
            $wish->product_id = $product->id;
            $wish->price = $product->sale_price;
            $wish->user_id = Auth::user()->id;
            $wish->quantity = '1';
            $wish->product_name = $product->name;
            $wish->seller_id = $request->sid ?? 1;
            $wish->product_image = $product->image;
            $wish->save();
            return response()->json([
                'status' => true,
                'msg' => 'Product Added to wishlist',
                // 'result' => $result
            ], 200);

        } else {

            return response()->json([
                'status' => false,
                'msg' => 'Product Not Found',
                // 'result' => $result
            ], 200);
        }
    }


    public function GetWishlist(Request $request)
    {
        $result['wishlist'] = Product::where('user_id', Auth::user()->id)->select('wishlists.*', 'products.slug', 'products.regular_price', 'products.discount_value', 'users.name as seller_name', 'users.id as seller_id')
            ->leftJoin('wishlists', 'products.id', '=', 'wishlists.product_id')
            ->leftJoin('users', 'wishlists.seller_id', '=', 'users.id')
            ->withAvg('reviews', 'rating')->get();
        // dd($result['wishlist']);
        return response()->json([
            'status' => true,
            'result' => $result
        ], 200);

    }

    public function Addcart(Request $request)
    {
        $uwish = Cart::where('user_id', Auth::user()->id)->where('product_id', $request->id)
            ->where('seller_id', $request->sid)->first();

        if (isset($uwish)) {
            if (isset($request->qty)) {
                if ($request->qty <= 0) {
                    $wish = Cart::find($uwish->id);
                    $wish->delete();
                    return response()->json([
                        'status' => true,
                        'msg' => 'Product remove from Cart successfully!',
                        // 'result' => $result
                    ], 200);
                }
                $wish = Cart::where('id', $uwish->id)->update(['quantity' => $request->qty]);
                return response()->json([
                    'status' => true,
                    'msg' => 'Product Qty Updated In Cart',
                ], 200);

            }
            $wish = Cart::find($uwish->id);
            $wish->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Product remove from Cart successfully!',
                // 'result' => $result
            ], 200);
        }
        // $product = Product::where('id', $request->id)->first();
        $product = Product::where('products.id', $request->id)
            ->join('vendor_products', 'vendor_products.product_id', '=', 'products.id')
            ->where('vendor_products.vendor_id', $request->sid)
            ->select('products.*', 'vendor_products.price as sale_price')
            ->first();

        if (isset($product)) {
            $wish = new Cart();
            $wish->product_id = $product->id;
            $wish->price = $product->sale_price;
            $wish->user_id = Auth::user()->id;
            $wish->quantity = $request->qty;
            $wish->seller_id = $request->sid ?? 1;
            $wish->product_name = $product->name;
            $wish->product_image = $product->image;
            $wish->save();
            return response()->json([
                'status' => true,
                'msg' => 'Product has been added to your cart',
                // 'result' => $result
            ], 200);

        } else {

            return response()->json([
                'status' => true,
                'msg' => 'Product Not Found',
                // 'result' => $result
            ], 404);
        }
    }

    public function GetCart(Request $request)
    {
        // $result['cart'] = Product::select('carts.*', 'products.slug', 'products.regular_price', 'products.discount_value', 'users.name as seller_name')
        //     ->leftJoin('carts', 'products.id', '=', 'carts.product_id')
        //     ->leftJoin('users', 'carts.seller_id', '=', 'users.id')
        //     ->where('carts.user_id', Auth::user()->id)
        //     ->withAvg('reviews', 'rating')->get();

        $carts = Cart::with([
            'product:id,name,image,slug,regular_price,sale_price,discount_value',
            'seller:id,name',
            'product.reviews'
        ])->where('user_id', Auth::id())->get();


        $result['cart'] = $carts->map(function ($cart) {
            $product = $cart->product;
            $sellerProduct = $cart->sellerProduct;

            $price = $sellerProduct->price ?? $product->sale_price;
            $discount = 0;
            if ($product->regular_price > 0 && $price) {
                $discount = round((($product->regular_price - $price) / $product->regular_price) * 100, 2);
                $discount = max($discount, 0);
            }

            return [
                'id' => $cart->id,
                'product_id' => $product->id,
                'user_id' => $cart->user_id,
                'seller_id' => $cart->seller_id,
                'product_name' => $product->name,
                'discount_value' => (string) $discount,
                'product_image' => $product->image,
                'price' => $sellerProduct->price ?? $product->sale_price,
                'quantity' => $cart->quantity,
                'slug' => $product->slug,
                'regular_price' => $product->regular_price,
                'seller_name' => $cart->seller->name ?? null,
                'reviews_avg_rating' => $product->reviews->avg('rating'),
                'created_at' => $cart->created_at,
                'updated_at' => $cart->updated_at,
            ];
        });

        return response()->json([
            'status' => true,

            'result' => $result
        ], 200);

    }


    public function SearchData(Request $request)
    {
        $search = $request->s;
        $result['per_page'] = $per_page = 10;
        $result['mip'] = $mip = Product::where('status', 1)->min('regular_price');
        $result['map'] = $map = Product::where('status', 1)->max('regular_price');
        $result['sorting'] = 'default';
        if ($request->has('per_page'))
            $per_page = $request->per_page;
        if ($request->has('mip'))
            $result['mip'] = $mip = $request->mip;
        if ($request->has('map'))
            $result['map'] = $map = $request->map;
        if ($request->has('sorting'))
            $result['sorting'] = $request->sorting;


        $category = Category::where('slug', 'like', '%' . $search . '%')->first();
        $subcategory = SubCategory::where('slug', 'like', '%' . $search . '%')->first();
        $brand = Brand::where('brand_slug', 'like', '%' . $search . '%')->first();

        $category_id = $category ? $category->id : null;
        $subcategory_id = $subcategory ? $subcategory->id : null;
        $brand_id = $brand ? $brand->id : null;

        $query = Product::query()
            ->where('status', 1)
            ->whereHas('activeVendorProducts')
            ->with([
                'seller', // gets all sellers
                'brands'
            ])
            ->withCount('reviews')
            ->withMin('activeVendorProducts as sale_price', 'price');

        if ($category_id) {
            $query->where('products.category_id', $category_id);
        } elseif ($subcategory_id) {
            $query->where('products.subcategory_id', $subcategory_id);
        } elseif ($brand_id) {
            $query->where('products.brand_id', $brand_id);
        } elseif (strlen($search) >= 3) {
            $query = $query->where('products.name', 'like', '%' . $search . '%');
        }

        if ($request->sorting == "date") {
            $query->orderBy('products.created_at', 'DESC');
        }
        if ($request->sorting == "price") {
            $query->orderBy('vendor_products.price', 'ASC');
        }
        if ($request->sorting == "price-desc") {
            $query->orderBy('vendor_products.price', 'DESC');
        }

        if (!empty($request->brandtype)) {
            $query->whereIn('products.brand_id', $request->brandtype);
        }

        if (!empty($request->discount)) {
            $query->where('products.discount_value', '>', max($request->discount));
        }

        $result['products'] = $query->withAvg('reviews', 'rating')
            ->withAvg('wishlist', 'user_id')
            ->withAvg('cart', 'user_id')
            ->distinct('products.id')
            ->paginate($per_page);
        // dd($request);
        // $products=$query->paginate($this->pagesize);

        return response()->json([
            'status' => true,
            'c' => $category_id,
            'b' => $brand_id,
            'sub' => $subcategory_id,
            'result' => $result

        ], 200);
    }

    public function UserAddress(Request $request)
    {
        // $ships = ShippingAddress::where('user_id',Auth::user()->id)->select('wishlists.*','products.slug')->leftJoin('products', 'products.id', '=', 'wishlists.product_id')->get();
        $addresss = ShippingAddress::where('user_id', Auth::user()->id)->with(['country'])->with(['city'])->with(['state'])->get();

        return response()->json([
            'status' => true,
            'addresss' => $addresss

        ], 200);


    }
    public function UserAddAddress(Request $request)
    {
        $countries = Country::all();
        // $states = State::where('country_id',$this->country_id)->get();
        //    $cities = City::where('state_id',$this->st_id)->get();
        return response()->json([
            'status' => true,
            'countries' => $countries

        ], 200);
    }

    public function StateData(Request $request)
    {

        $states = State::where('country_id', $request->c)->orderBy('name', 'ASC')->get();
        //    $cities = City::where('state_id',$this->st_id)->get();
        return response()->json([
            'status' => true,
            'states' => $states

        ], 200);
    }

    public function CityData(Request $request)
    {

        $cities = City::where('state_id', $request->s)->orderBy('name', 'ASC')->get();
        return response()->json([
            'status' => true,
            'cities' => $cities

        ], 200);
    }

    public function StoreAddres(Request $request)
    {
        $data = $request->all();
        foreach (['country_id', 'state_id', 'city_id'] as $field) {
            if ($data[$field] == 'null' || $data[$field] == '' || $data[$field] == "") {
                $data[$field] = null;
            }
        }

        $valid = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'numeric', 'digits:10'],
            'line1' => ['required', 'string', 'max:255'],
            'landmark' => ['nullable', 'string', 'max:255'],
            'country_id' => ['required', 'not_in:null'],
            'state_id' => ['required', 'not_in:null'],
            'city_id' => ['required', 'not_in:null'],
            'zipcode' => ['required', 'string', 'max:6'],
            'address_type' => ['required'],
        ], [
            'name.required' => 'Name is required.',
            'mobile.required' => 'Mobile number is required.',
            'mobile.numeric' => 'Mobile number must be numeric.',
            'mobile.digits' => 'Mobile number must be exactly 10 digits.',
            'line1.required' => 'Address line is required.',
            'country_id.required' => 'Country is required.',
            'country_id.not_in' => 'Please select a valid country.',
            'state_id.required' => 'State is required.',
            'state_id.not_in' => 'Please select a valid state.',
            'city_id.required' => 'City is required.',
            'city_id.not_in' => 'Please select a valid city.',
            'zipcode.required' => 'Zipcode is required.',
            'zipcode.max' => 'Zipcode must be a maximum of 6 characters.',
            'address_type.required' => 'Address type is required.',
        ]);

        if (!$valid->passes()) {
            return response()->json([
                'status' => false,
                'msg' => 'validation error',
                'errors' => $valid->errors()
            ], 200);
        } else {
            if ($request->id > 0) {
                $model = ShippingAddress::find($request->id);
                $msg = "Shiping Address Updated successfully";
            } else {
                $model = new ShippingAddress();
                $msg = "Shiping Address Added successfully";
            }

            $model->user_id = Auth::user()->id;
            $model->name = $request->name;
            $model->mobile = $request->mobile;
            $model->mobile_optional = $request->mobile_optional;
            $model->line1 = $request->line1;
            $model->line2 = $request->line2;
            $model->landmark = $request->landmark;
            $model->country_id = $request->country_id;
            $model->state_id = $request->state_id;
            $model->city_id = $request->city_id;
            $model->zipcode = $request->zipcode;
            $model->address_type = $request->address_type;

            if ($request->default_address == 1) {
                ShippingAddress::where('user_id', Auth::user()->id)->update(['default_address' => 0]);
                // $model->default_address = '1';
            }
            $model->default_address = $request->default_address;
            $model->save();
        }

        return response()->json([
            'status' => true,
            'msg' => $msg,
            // 'result' => $result

        ], 200);
    }

    public function DeleteAddres(Request $request)
    {
        $model = ShippingAddress::find($request->id);
        $model->delete();
        return response()->json([
            'status' => true,
            'msg' => "Shiping Address Deleted successfully",
            // 'result' => $result

        ], 200);

    }

    public function DefaultAddres(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        if ($status == 1) {
            ShippingAddress::where('user_id', Auth::user()->id)->update(['default_address' => 0]);
            $model = ShippingAddress::find($request->id);

        } else {
            $model = ShippingAddress::find($request->id);
        }
        $model->default_address = $status;
        $model->save();
        return response()->json([
            'status' => true,
            'msg' => "Shiping Address Updated successfully",
            // 'result' => $result

        ], 200);


    }

    public function PromoCode(Request $request)
    {
        $result['coupons'] = Coupon::where('status', 1)->get();
        return response()->json([
            'status' => true,
            'result' => $result

        ], 200);
    }

    public function UserOrder(Request $request)
    {
        $orders = Order::where('user_id', Auth::user()->id)->with(['transaction'])->get();
        \Log::info('info' . $orders);
        $orders->map(function ($order) {
            $order->transaction->mode = ($order->transaction->mode == 'cod') ? 'cod' : 'online';
            
            return $order;
        });
        
        $result['order'] = $orders;

        return response()->json([
            'status' => true,
            'result' => $result

        ], 200);
    }

    public function UserOrderDetails(Request $request)
    {
        $id = $request->oid;
        $result['order'] = Order::where('id', $id)->with(['transaction'])->first();
        $result['order']->transaction->mode = ($result['order']->transaction->mode == 'cod') ? 'cod' : 'online';

        $result['orderitem'] = OrderItem::where('order_id', $id)->with(['product', 'seller'])->get();

        return response()->json([
            'status' => true,
            'result' => $result
        ], 200);

    }

    public function MoveToCart(Request $request)
    {
        $id = $request->id;
        $wishlist = Wishlist::findOrFail($id);

        if ($wishlist) {
            $cartcheck = Cart::where('user_id', Auth::user()->id)->where('product_id', $wishlist->product_id)->where('seller_id', $wishlist->seller_id)->first();
            if (!isset($cartcheck)) {
                $cart = new Cart();
                $cart->user_id = Auth::user()->id;
                $cart->product_id = $wishlist->product_id;
                $cart->product_name = $wishlist->product_name;
                $cart->product_image = $wishlist->product_image;
                $cart->seller_id = $wishlist->seller_id ?? 1;
                $cart->price = $wishlist->price;
                $cart->quantity = $wishlist->quantity;
                $cart->save();
                $wishlist->delete();
                $msg = "Item moved to cart successfully!";
            } else {
                $msg = "Item Already Added to Cart!";
            }


        }
        return response()->json([
            'status' => true,
            'msg' => $msg
            // 'result' => $result

        ], 200);

    }

    public function MoveToWish(Request $request)
    {
        $id = $request->id;
        $wishlist = Cart::findOrFail($id);
        // dd($wishlist);
        if ($wishlist) {
            $cartcheck = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $wishlist->product_id)->where('seller_id', $wishlist->seller_id)->first();
            if (!isset($cartcheck)) {
                $cart = new Wishlist();
                $cart->user_id = Auth::user()->id;
                $cart->product_id = $wishlist->product_id;
                $cart->product_name = $wishlist->product_name;
                $cart->product_image = $wishlist->product_image;
                $cart->price = $wishlist->price;
                $cart->seller_id = $wishlist->seller_id ?? 1;
                $cart->quantity = $wishlist->quantity;
                $cart->save();
                $wishlist->delete();
                $msg = "Item added to wishlist successfully!";
            } else {
                $msg = "Item Already Added to Wishlist!";
            }
        }
        return response()->json([
            'status' => true,
            'msg' => $msg,
            // 'result' => $result

        ], 200);
    }
    public function ClearCart(Request $request)
    {
        $wishlist = Cart::where('user_id', Auth::user()->id)->get();
        if ($wishlist[0]) {
            foreach ($wishlist as $item) {
                $ewishlist = Cart::find($item->id);
                $ewishlist->delete();
            }
        }
        return response()->json([
            'status' => true,
            'msg' => "Items Removed From cart successfully!",
            // 'result' => $result

        ], 200);
    }

    public function ClearWish(Request $request)
    {
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->get();
        if ($wishlist[0]) {
            foreach ($wishlist as $item) {
                $ewishlist = Wishlist::find($item->id);
                $ewishlist->delete();
            }
        }
        return response()->json([
            'status' => true,
            'msg' => "Items Removed From Wishlist successfully!",
            // 'result' => $result

        ], 200);
    }

    public function Shop(Request $request)
    {
        $result['per_page'] = $per_page = 20;
        $mip = Product::where('status', 1)->min('regular_price');
        $map = Product::where('status', 1)->max('regular_price');
        if ($request->has('per_page'))
            $per_page = $request->per_page;
        if ($request->has('mip'))
            $mip = $request->mip;
        if ($request->has('map'))
            $map = $request->map;


        $query = Product::whereHas('activeVendorProducts')
            ->whereHas('category', function ($q) {
                $q->where('status', 1);
            })
            ->whereHas('subCategories', function ($q) {
                $q->where('status', 1);
            })
            ->whereBetween('regular_price', [$mip, $map])->where('status', 1);

        if ($request->sorting == "date") {
            $query = $query->orderBy('created_at', 'DESC');
        }
        if ($request->sorting == "price") {
            $query = $query->orderBy('regular_price', 'ASC');
        }
        if ($request->sorting == "price-desc") {
            $query = $query->orderBy('regular_price', 'DESC');
        }
        if ($request->brandtype != null) {
            $query = $query->whereIn('brand_id', $request->brandtype);
        }
        if ($request->breedtype != null) {
            $query = $query->whereIn('breed_id', $request->breedtype);
        }
        if ($request->flavourtype != null) {
            $query = $query->whereIn('flavour_id', $request->flavourtype);
        }

        if ($request->discount != null) {
            $query = $query->where('discount_value', '>', max($request->discount));

        }

        $query = $query->distinct()->select('products.*')->with(['brands', 'seller'])->withAvg('reviews', 'rating')->withAvg('wishlist', 'user_id')->withCount('reviews')->withAvg('cart', 'user_id');

        $result['products'] = $query->paginate($per_page);


        $result['products']->setCollection(
            $result['products']->getCollection()->map(function ($product) {
                $discount = 0;
                if ($product->regular_price > 0 && isset($product->seller->price)) {
                    $discount = round((($product->regular_price - $product->seller->price) / $product->regular_price) * 100, 2);
                    $discount = max($discount, 0);
                }

                $product->discount_value = (string) $discount;
                $product->sale_price = str($product->seller->price ?? 0);
                return $product;
            })
        );






        // $result['products'] = Product::where('status',1)->with(['reviews','questions','category','subCategories','brands'])->withAvg('wishlist','user_id')->withAvg('cart','user_id')->withAvg('reviews', 'rating')->paginate($per_page);

        return response()->json([
            'status' => true,
            'result' => $result
        ], 200);
    }
    public function vendorProducts(Request $request, $vid)
    {
        $result['per_page'] = $per_page = 20;
        $mip = Product::where('status', 1)->min('regular_price');
        $map = Product::where('status', 1)->max('regular_price');
        if ($request->has('per_page'))
            $per_page = $request->per_page;
        if ($request->has('mip'))
            $mip = $request->mip;
        if ($request->has('map'))
            $map = $request->map;


        $query = Product::whereHas('vendorProducts', function ($query) use ($vid) {
            $query->where('vendor_products.vendor_id', $vid);
        })->whereBetween('regular_price', [$mip, $map])->where('status', 1);

        if ($request->sorting == "date") {
            $query = $query->orderBy('created_at', 'DESC');
        }
        if ($request->sorting == "price") {
            $query = $query->orderBy('regular_price', 'ASC');
        }
        if ($request->sorting == "price-desc") {
            $query = $query->orderBy('regular_price', 'DESC');
        }
        if ($request->brandtype != null) {
            $query = $query->whereIn('brand_id', $request->brandtype);
        }
        if ($request->breedtype != null) {
            $query = $query->whereIn('breed_id', $request->breedtype);
        }
        if ($request->flavourtype != null) {
            $query = $query->whereIn('flavour_id', $request->flavourtype);
        }

        if ($request->discount != null) {
            $query = $query->where('discount_value', '>', max($request->discount));

        }

        $query = $query->distinct()->select('products.*')->with(['brands', 'seller'])->withAvg('reviews', 'rating')->withAvg('wishlist', 'user_id')->withCount('reviews')->withAvg('cart', 'user_id');

        $result['products'] = $query->paginate($per_page);









        // $result['products'] = Product::where('status',1)->with(['reviews','questions','category','subCategories','brands'])->withAvg('wishlist','user_id')->withAvg('cart','user_id')->withAvg('reviews', 'rating')->paginate($per_page);

        return response()->json([
            'status' => true,
            'result' => $result
        ], 200);
    }


    public function Checkout(Request $request)
    {
        // $cart = [];
        // $count = 0;
        // $subtotalc = 0;
        // $taxtotalc = 0;



        // dd($carts);

        // $savelater = [];
        // $uploadper = 0;
        $pricesoff = 0;
        // $discount = 0;
        $cartlsit = Cart::where('user_id', Auth::user()->id)->pluck('product_id')->toArray();
        $result['cart'] = $cart = Cart::with(['product'])->where('user_id', Auth::user()->id)->get();
        // $catlistnumber = Product::whereIn('id', $cartlsit)->pluck('category_id')->toArray();
        $count = Cart::where('user_id', Auth::user()->id)->get()->count();
        $subtotalc = 0;
        $taxtotalc = 0;
        foreach ($cart as $item) {
            $dffg = Cart::where('id', $item->id)->first();

            if (isset($item->sellerProduct) && !empty($item->sellerProduct)) {
                $price = $item->sellerProduct->price;
                $mprice = $item->product->regular_price;

            } else {
                $price = $item->product->sale_price;
                $mprice = $item->product->regular_price;
            }

            $item['qty'] = $dffg->quantity;


            $subtotalc = $subtotalc + $price * $dffg->quantity;
            $taxtotalc = $taxtotalc + (($item->product->taxslab->value * $price) * ($dffg->quantity) / 100);
            $pricesoff = $pricesoff + (($mprice - $price) * ($dffg->quantity));

        }
        // dd($subtotalc,$taxtotalc);
        $result['taxvalue'] = $taxtotalc;
        $result['subtotal'] = $subtotalc;
        $result['totalamount'] = $pricesoff + $subtotalc;

        if ($result['totalamount'] >= 200) {
            $result['shippingcost'] = 0;
        } else {
            $result['shippingcost'] = 80;
        }
        $result['addresss'] = ShippingAddress::where('user_id', Auth::user()->id)->with(['country'])->with(['city'])->with(['state'])->where('default_address', 1)->first();

        return response()->json([
            'status' => true,
            'result' => $result
        ], 200);
    }

    public function CouponApply(Request $request)
    {
        try {
            $valid = Validator::make($request->all(), [
                'totalamount' => ['required', 'numeric'],
                'subtotal' => ['required', 'numeric'],
                'CouponCode' => ['required', 'string'],
            ]);
            if (!$valid->passes()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $valid->errors()
                ], 200);
            } else {

                $coupon = Coupon::where('code', $request->CouponCode)->where('status', 1)->first();
                if (!$coupon) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Coupon code is invalid',
                    ], 200);
                }

                if ($coupon->category_id != '') {
                    $catlist = Cart::where('user_id', Auth::user()->id)->pluck('product_id')->toArray();
                    $cat = Product::whereIn('id', $catlist)->pluck('category_id')->toArray();
                    // dd($cat);
                    $cat = array_unique($cat);
                    if (count($cat) == 1) {
                        // $cat_id = array_unique($cat);
                        if ($cat[0] == $coupon->category_id) {
                            //with cart value
                            if ($coupon->cart_value != '') {
                                if ($coupon->cart_value <= $request->subtotal) {
                                    $result['coupondata'] = $coupon;
                                    if ($coupon->type == '2') {
                                        $result['discount'] = $coupon->value;
                                    } else {
                                        $result['discount'] = ($request->subtotal * $coupon->value) / 100;
                                    }
                                    $result['subtotal'] = $request->subtotal;
                                    $result['totalamount'] = $request->totalamount;
                                    // session()->put('coupon',[
                                    // 'code' =>$coupon->code,
                                    // 'type' =>$coupon->type,
                                    // 'value' =>$coupon->value,
                                    // 'cat_id' =>$coupon->category_id,
                                    // 'cart_value'=>$coupon->cart_value
                                    // ]);

                                    return response()->json([
                                        'status' => true,
                                        'message' => 'Coupon code is Valid and Applied',
                                        'result' => $result
                                    ], 200);
                                } else {
                                    return response()->json([
                                        'status' => false,
                                        'message' => 'Coupon code is Valid But Cart ammount is less',
                                    ], 200);
                                    // session()->flash('coupon_message','Coupon code is Valid But Cart ammount is less');
                                    // return;
                                }
                            } else {
                                $result['coupondata'] = $coupon;
                                if ($coupon->type == '2') {
                                    $result['discount'] = $coupon->value;
                                } else {
                                    $result['discount'] = ($request->subtotal * $coupon->value) / 100;
                                }
                                $result['subtotal'] = $request->subtotal;
                                $result['totalamount'] = $request->totalamount;
                                return response()->json([
                                    'status' => true,
                                    'message' => 'Coupon code is Valid and Applied',
                                    'result' => $result
                                ], 200);
                            }

                        } else {
                            return response()->json([
                                'status' => false,
                                'message' => 'Coupon code is Valid but Other Category product added!',
                            ], 200);
                            // session()->flash('coupon_message','Coupon code is Valid but Other Category product added!');
                            // return;
                        }
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => 'Coupon code is Valid but Other Category product added!',
                        ], 200);
                        //     session()->flash('coupon_message','Coupon code is Valid but Other Category product added!');
                        //     return;
                    }

                }


                if ($coupon->brand_id != '') {

                    $catlist = Cart::where('user_id', Auth::user()->id)->pluck('product_id')->toArray();
                    $bat = Product::whereIn('id', $catlist)->pluck('brand_id')->toArray();
                    $bat = array_unique($bat);
                    if (count($bat) == 1) {
                        // $cat_id = array_unique($cat);
                        if ($bat[0] == $coupon->brand_id) {
                            //with cart value
                            if ($coupon->cart_value != '') {
                                if ($coupon->cart_value <= $request->subtotal) {
                                    $result['coupondata'] = $coupon;
                                    if ($coupon->type == '2') {
                                        $result['discount'] = $coupon->value;
                                    } else {
                                        $result['discount'] = ($request->subtotal * $coupon->value) / 100;
                                    }
                                    $result['subtotal'] = $request->subtotal;
                                    $result['totalamount'] = $request->totalamount;
                                    return response()->json([
                                        'status' => true,
                                        'message' => 'Coupon code is Valid and Applied',
                                        'result' => $result
                                    ], 200);

                                } else {
                                    return response()->json([
                                        'status' => false,
                                        'message' => 'Coupon code is Valid But Cart ammount is less',
                                    ], 200);
                                }
                            } else {
                                $result['coupondata'] = $coupon;
                                if ($coupon->type == '2') {
                                    $result['discount'] = $coupon->value;
                                } else {
                                    $result['discount'] = ($request->subtotal * $coupon->value) / 100;
                                }
                                $result['subtotal'] = $request->subtotal;
                                $result['totalamount'] = $request->totalamount;
                                return response()->json([
                                    'status' => true,
                                    'message' => 'Coupon code is Valid and Applied',
                                    'result' => $result
                                ], 200);
                            }

                        } else {
                            return response()->json([
                                'status' => false,
                                'message' => 'Coupon code is Valid but Other Brand product added!',
                            ], 200);
                        }
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => 'Coupon code is Valid but Other Brand product added!',
                        ], 200);
                    }
                }


                if ($coupon->cart_value != '') {
                    if ($coupon->cart_value <= $request->subtotal) {
                        $result['coupondata'] = $coupon;
                        if ($coupon->type == '2') {
                            $result['discount'] = $coupon->value;
                        } else {
                            $result['discount'] = ($request->subtotal * $coupon->value) / 100;
                        }
                        $result['subtotal'] = $request->subtotal;
                        $result['totalamount'] = $request->totalamount;
                        return response()->json([
                            'status' => true,
                            'message' => 'Coupon code is Valid and Applied',
                            'result' => $result
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => 'Coupon code is Valid But Cart ammount is less',
                        ], 200);
                    }
                }

                $result['coupondata'] = $coupon;
                if ($coupon->type == '2') {
                    $result['discount'] = $coupon->value;
                } else {
                    $result['discount'] = ($request->subtotal * $coupon->value) / 100;
                }
                $result['subtotal'] = $request->subtotal;
                $result['totalamount'] = $request->totalamount;
                return response()->json([
                    'status' => true,
                    'message' => 'Coupon code is Valid and Applied',
                    'result' => $result
                ], 200);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function AddReview(Request $request)
    {
        $id = $request->id;
        $result['orderitem'] = OrderItem::where('id', $id)->with(['product'])->first();
        $result['order'] = Order::where('id', $result['orderitem']->order_id)->first();
        //  $result['product'] = Product::where('id',$result['orderitem']->product_id)->first();


        return response()->json([
            'status' => true,
            'result' => $result
        ], 200);
    }

    public function StoreReview(Request $request)
    {
        try {
            //Validated

            // dd($request);

            $valid = Validator::make($request->all(), [
                'product_id' => ['required', 'numeric'],
                'rating' => ['required', 'numeric'],
                'message' => ['required', 'string'],
                'order_id' => ['required'],
            ]);
            if (!$valid->passes()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $valid->errors()
                ], 200);
            } else {

                $review = new review();
                $review->product_id = $request->product_id;
                $review->user_id = Auth::id();
                $review->message = $request->message;
                $review->rating = $request->rating;
                if ($request->has('images')) {
                    //  dd($request->file('images'));
                    $imagesname = '';
                    foreach ($request->file('images') as $key => $image) {
                        // dd('fdgfdgf');
                        $imgName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                        $image->storeAs('review', $imgName);
                        $imagesname = $imagesname . ',' . $imgName;
                    }
                    //  dd($imagesname);
                    $review->images = $imagesname;
                }
                $review->order_id = $request->order_id;
                $review->orderlist_id = $request->orderlist_id;
                $review->save();
                return response()->json([
                    'status' => true,
                    'message' => 'Review has been Submited Successfully',
                ], 200);
            }


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function OrderPlace(Request $request)
    {
        try {
            $valid = Validator::make($request->all(), [
                'payment_type' => 'required',
                'subtotal' => ['required', 'numeric'],
                'discount' => ['required', 'string'],
                'tax' => ['required'],
                'shipping_charge' => 'required',
                'total' => 'required',
                'shipping_id' => 'required',
            ]);
            if (!$valid->passes()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $valid->errors()
                ], 200);
            } else {

                // $rewardpoint = $this->rewardingpoints();
                // $reward = RewardPonitSetting::where('cart_value', '<=', $request->subtotal)->where('status', '1')->orderby('cart_value', 'DESC')->first();
                if (isset($reward)) {
                    $rewardpoint = (floor($request->subtotal / $reward->cart_value)) * $reward->value;
                } else {
                    $rewardpoint = 0;
                }
                $ship = ShippingAddress::where('user_id', Auth::user()->id)->where('id', $request->shipping_id)->first();

                $order = new Order();
                $order->user_id = Auth::user()->id;
                $order->subtotal = $request->subtotal;
                $order->discount = $request->discount;
                $order->tax = $request->tax;
                $order->shipping_charge = $request->shipping_charge;
                $order->total = $request->total;
                //session()->get('checkout')['total'];
                $order->rewardpoint = $rewardpoint;
                $order->name = $ship->name;
                $order->mobile = $ship->mobile;
                $order->mobile_optional = $ship->mobile_optional;
                $order->line1 = $ship->line1;
                $order->line2 = $ship->line2;
                $order->landmark = $ship->landmark;
                $order->city_id = $ship->city_id;
                $order->state_id = $ship->state_id;
                $order->country_id = $ship->country_id;
                $order->zipcode = $ship->zipcode;
                $order->order_number = Carbon::now()->timestamp;
                $order->status = 'ordered';
                $order->save();
                $carts = Cart::with(['product'])->where('user_id', Auth::user()->id)->get();
                // dd($carts);
                foreach ($carts as $item) {

                    $orderItem = new OrderItem();
                    if (isset($item->sellerProduct) && !empty($item->sellerProduct)) {
                        $orderItem->price = $item->sellerProduct->price;
                        $orderItem->seller_id = $item->seller_id;

                    } else {
                        $orderItem->price = $item->product->sale_price;
                        $orderItem->seller_id = 1;
                    }
                    $orderItem->product_id = $item->product_id;
                    $orderItem->order_id = $order->id;
                    $orderItem->mrp_price = $item->product->regular_price;
                    $orderItem->gst = $item->product->taxslab->value;
                    $orderItem->quantity = $item->quantity;
                    $orderItem->options = $item->product->tax_id;
                    $orderItem->save();
                }

                $payment_status = $request->payment_type == 'razorpay' ? 'approved' : 'pending';
                // $this->rewardingpoints($order->id, $rewardpoint);
                if ($request->payment_type == 'cod') {
                    $this->makeTransaction($order->id, $payment_status, $request->payment_type, null, $request->subtotal);
                    $this->resetCart();
                    $this->sendOrderConfirmationMail($order);
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Order has been Submited Successfully',
                    'result' => $order
                ], 200);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }


    }
    public function completepayment(Request $request)
    {
        try {
            $valid = Validator::make($request->all(), [
                'transaction_id' => 'required',
                'order_id' => 'required',
                'status' => 'required',
            ]);
            if (!$valid->passes()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $valid->errors()
                ], 200);
            } else {

                $order = Order::findOrFail($request->order_id);

                $payment_status = ($request->status == 'failed') ? 'declined' : ($request->status == 'success' ? 'approved' : 'pending');

                $this->makeTransaction($order->id, $payment_status, 'razorpay', $request->transaction_id, $order->subtotal);
                $this->resetCart();
                $this->sendOrderConfirmationMail($order);

                return response()->json([
                    'status' => true,
                    'message' => 'Payment has been completed Successfully',
                ], 200);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }


    }

    public function rewardingpoints($order_id, $rewardpoint)
    {
        $modelR = new RewardTransaction();
        $modelR->user_id = Auth::user()->id;
        $modelR->order_id = $order_id;
        $modelR->point = $rewardpoint;
        $modelR->save();
        return;
    }

    public function makeTransaction($order_id, $status, $mode, $tran_id, $amount)
    {
        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = $order_id;
        $transaction->mode = $mode;
        $transaction->status = $status;
        $transaction->transaction_id = $tran_id;
        $transaction->amount = $amount;
        $transaction->currency_code = 'INR';
        $transaction->save();
        return;
    }
    public function resetCart()
    {
        $this->thankyou = 1;
        Cart::where('user_id', Auth::user()->id)->delete();
        // session()->forget('checkout');
        return;
    }
    public function sendOrderConfirmationMail($order)
    {
        Mail::to(Auth::user()->email)->send(new OrderMail($order));
        return;
    }


    public function WebSetting(Request $request)
    {
        $websetting = Websetting::find(1);
        return response()->json([
            'status' => true,
            'result' => $websetting,
            'dollar_rate' => '83.45'
        ], 200);

    }

    public function OrderCancel(Request $request)
    {
        try {
            $id = $request->id;
            $oid = $request->oid;
            if (isset($request->oid)) {
                $orderitem = OrderItem::where('order_id', $id)->where('id', $request->oid)->first();

                if (isset($orderitem)) {
                    $model = OrderItem::find($request->oid);
                    $model->rstatus = '1';
                    $model->canceled_date = DB::raw('CURRENT_DATE');
                    $model->save();

                    return response()->json([
                        'status' => true,
                        'message' => 'Order Item  has been Canceled Successfully',
                    ], 200);
                }
            } else {
                $order = Order::where('user_id', Auth::user()->id)->where('id', $id)->first();
                if (isset($order)) {
                    $model = Order::find($id);
                    $model->status = 'canceled';
                    $model->canceled_date = DB::raw('CURRENT_DATE');
                    $model->save();

                    OrderItem::where('order_id', $id)->update(['rstatus' => '1', 'canceled_date' => DB::raw('CURRENT_DATE')]);

                    return response()->json([
                        'status' => true,
                        'message' => 'Order has been canceled Successfully',
                    ], 200);
                }
            }
            return response()->json([
                'status' => true,
                'message' => 'Order not found',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function Userwallet(Request $request)
    {
        $walletd = WalletTransaction::where('user_id', Auth::user()->id)->get();
        $rewardd = RewardTransaction::where('user_id', Auth::user()->id)->get();


        $result['twallet'] = ($walletd->where('status', '1')->sum('amount') - $walletd->where('status', '2')->sum('amount'));
        $result['treward'] = ($rewardd->where('status', '1')->sum('point') - $rewardd->where('status', '2')->sum('point'));
        $result['wallethistory'] = WalletTransaction::Leftjoin('orders', 'orders.id', '=', 'wallet_transactions.order_id')->select('orders.order_number', 'wallet_transactions.*')->where('wallet_transactions.user_id', Auth::user()->id)->get();
        $result['rewardhistory'] = RewardTransaction::Leftjoin('orders', 'orders.id', '=', 'reward_transactions.order_id')->select('orders.order_number', 'reward_transactions.*')->where('reward_transactions.user_id', Auth::user()->id)->get();


        return response()->json([
            'status' => true,
            'result' => $result
        ], 200);
    }

}