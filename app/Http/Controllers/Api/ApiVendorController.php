<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Models\VendorProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ApiVendorController extends Controller
{
    public function home()
    {
        $result['totalProducts'] = Product::where('status', 1)->count();
        $result['totalSellers'] = User::where('utype', 'VDR')->count();
        $result['vendorProducts'] = VendorProduct::where('vendor_id', Auth::id())->count();
        $result['totalVendorOrders'] = OrderItem::where('seller_id', Auth::id())->count();

        return response()->json([
            'status' => true,
            'result' => $result

        ], 200);
    }
    public function variant()
    {
        $result['variant_list'] = VendorProduct::with('productApi')->where('vendor_id', auth()->id())->get();

        return response()->json([
            'status' => true,
            'result' => $result

        ], 200);
    }

    public function addVariant(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'additional_info' => 'nullable|string',
        ]);
        if (!$valid->passes()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $valid->errors()
            ], 200);
        } else {
            $vendorProduct = new VendorProduct();
            $vendorProduct->product_id = $request->product_id;
            $vendorProduct->vendor_id = Auth::id();
            $vendorProduct->price = $request->price;
            $vendorProduct->quantity = $request->quantity;
            $vendorProduct->additional_info = $request->additional_info ?? null;
            $vendorProduct->save();

            return response()->json([
                'status' => true,
                'result' => $vendorProduct
            ], 200);
        }
    }
    public function updateVariant(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'additional_info' => 'nullable|string',
            'status' => 'nullable|string',
        ]);
        if (!$valid->passes()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $valid->errors()
            ], 200);
        } else {
            $vendorProduct = VendorProduct::where('product_id', $request->product_id)->where('vendor_id', Auth::id())->first();
            $vendorProduct->price = $request->price;
            $vendorProduct->quantity = $request->quantity;
            $vendorProduct->status = $request->status;
            $vendorProduct->additional_info = $request->additional_info ?? null;
            $vendorProduct->save();

            return response()->json([
                'status' => true,
                'message' => 'Variant Updated Successfully'
            ], 200);
        }
    }
    public function stockStatusToggle(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'variant_id' => 'required|exists:vendor_products,id',
        ]);
        if (!$valid->passes()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $valid->errors()
            ], 200);
        } else {
            $vendorProduct = VendorProduct::where('id', $request->variant_id)->where('vendor_id', Auth::id())->first();
            if (isset($vendorProduct) && !empty($vendorProduct)) {
                $vendorProduct->stock_status = ($vendorProduct->stock_status === 'instock') ? 'outofstock' : 'instock';
                $vendorProduct->save();
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'No Variant Found!'
                ], 200);
            }

            return response()->json([
                'status' => true,
                'message' => 'Stock Status Updated Successfully'
            ], 200);
        }
    }

    public function ProductData(Request $request)
    {

        // $result['category'] = Category::where('id',$request->id)->first();
        // $result['subcategorys'] = SubCategory::where('category_id',$request->id)->get();
        //  $result['cbanners'] = Banner::where('status',1)->where('for',$request->id)->get();
        $result['product'] = Product::where('slug', $request->id)->with(['questions', 'category', 'subCategories', 'brands', 'seller'])->withAvg('reviews', 'rating')->withAvg('wishlist', 'user_id')->withAvg('cart', 'user_id')->first();
        if ($result['product']->parent_id) {
            $result['varaiants'] = Product::where('parent_id', $result['product']->parent_id)->orWhere('id', $result['product']->parent_id)->select('products.id', 'products.variant_detail', 'products.regular_price', 'products.sale_price', 'products.slug')->get();
        } else {
            $result['varaiants'] = Product::where('parent_id', $result['product']->id)->orWhere('id', $result['product']->id)->select('products.id', 'products.variant_detail', 'products.regular_price', 'products.sale_price', 'products.slug')->get();
        }
        $result['shareButtons'] = \Share::page(route('product-details', ['slug' => $result['product']->slug]))->facebook()->twitter()->linkedin()->telegram()->whatsapp()->reddit();
        $result['reviews'] = Review::where('product_id', $result['product']->id)->with(['user'])->get();
        $result['seller_list'] = VendorProduct::leftJoin('users', 'vendor_products.vendor_id', '=', 'users.id')
            ->where('vendor_products.product_id', $result['product']->id)
            ->whereNot('vendor_products.vendor_id', $result['product']->seller->vendor_id ?? 1)
            ->select('vendor_products.*', 'users.name as seller_name')
            ->get();
        $result['seller_cart_list'] = Cart::where('product_id', $result['product']->id)
            ->where('user_id', Auth::id())
            ->select('seller_id')->get();

        $isVendorExist = VendorProduct::where('product_id', $result['product']->id)->where('vendor_id', Auth::id())->first();
        $result['edit'] = isset($isVendorExist) ? 'yes' : 'no';
        return response()->json([
            'status' => true,
            'result' => $result

        ], 200);
    }

    public function editVariant($id)
    {
        $isVendorExist = VendorProduct::with('productApi')->where('product_id', $id)->where('vendor_id', Auth::id())->first();

        return response()->json([
            'status' => true,
            'result' => $isVendorExist

        ], 200);
    }
    public function orderList()
    {
        // $orders = Order::whereHas('orderItemsApi', function ($query) {
        //     $query->where('orderitems.seller_id', Auth::id());
        // })->with(['orderItemsApi'])->get();

        $orders = OrderItem::where('seller_id', Auth::id())->with(['orderApi', 'productApi'])->get();

        return response()->json([
            'status' => true,
            'result' => $orders
        ], 200);
    }
    public function orderDetails($id)
    {
        $orders = OrderItem::where('id', $id)->where('seller_id', Auth::id())->with(['orderApi.country','orderApi.state','orderApi.city','productApi'])->first();

        return response()->json([
            'status' => true,
            'result' => $orders
        ], 200);
    }
}
