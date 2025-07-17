<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductHistory;
use App\Models\Review;
use App\Models\User;
use App\Models\VendorProduct;
use App\Models\VendorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use function PHPUnit\Framework\returnArgument;

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

            $existing = VendorProduct::where('product_id', $request->product_id)
                ->where('vendor_id', Auth::id())
                ->first();

            if ($existing) {
                return response()->json([
                    'status' => false,
                    'message' => 'This product variant already exists for the vendor.',
                ], 200);
            }
            $vendorProduct = new VendorProduct();
            $vendorProduct->product_id = $request->product_id;
            $vendorProduct->vendor_id = Auth::id();
            $vendorProduct->price = $request->price;
            $vendorProduct->quantity = $request->quantity;
            $vendorProduct->additional_info = $request->additional_info ?? null;
            $vendorProduct->save();

            ProductHistory::create([
                'seller_id' => $vendorProduct->vendor_id,
                'product_id' => $vendorProduct->product_id,
                'type' => 'add',
                'quantity' => $request->quantity,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Product Added Successfully!',
                'result' => $vendorProduct
            ], 200);
        }
    }
    public function updateVariant(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'price' => 'required|numeric|min:1',
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
    public function vendorOrders()
    {
        $orders = OrderItem::where('seller_id', Auth::id())
            ->get()
            ->groupBy('order_id')
            ->map(function ($items) {
                $first = $items->first();

                return [
                    'order_id' => $first->order_id,
                    'created_at' => $first->created_at,
                    'order_number' => $first->orderApi->order_number ?? null,
                    'status' => $first->status,
                    'total_price' => $items->sum(function ($item) {
                        return ($item->price ?? 0) * ($item->quantity ?? 1);
                    }),
                    'total_products' => $items->count(),
                ];
            })
            ->values();

        return response()->json([
            'status' => true,
            'result' => $orders
        ], 200);
    }
    public function orderList($id)
    {
        $orders = OrderItem::where('order_id', $id)->where('seller_id', Auth::id())->with(['orderApi', 'productApi'])->get();

        return response()->json([
            'status' => true,
            'result' => $orders
        ], 200);
    }
    public function orderDetails($id)
    {
        $orders = OrderItem::where('id', $id)->where('seller_id', Auth::id())->with(['orderApi.country', 'orderApi.state', 'orderApi.city', 'productApi'])->first();

        return response()->json([
            'status' => true,
            'result' => $orders
        ], 200);
    }

    public function Profile(Request $request)
    {
        $result['user_detail'] = Auth::user();
        $result['seller_details'] = VendorProfile::where('vendor_id', Auth::id())->first();
        return response()->json([
            'status' => true,
            'result' => $result
        ], 200);
    }

    public function profileUpdate(Request $request)
    {
        $data = $request->validate([
            'address' => 'required|string',
            'country' => 'required|exists:countries,id',
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',
            'pin_code' => 'required',
            'id_proof_type' => 'nullable|string',
            'proof_image' => 'nullable',
            'gstin_number' => 'nullable',
            'gstin_image' => 'nullable',
        ]);


        $data['vendor_id'] = auth()->id();

        if ($request->hasFile('proof_image')) {
            $proofImage = $request->file('proof_image');
            $proofImageName = time() . '_' . $proofImage->getClientOriginalName();
            $proofImage->move(public_path('assets/vendor/proofs'), $proofImageName);
            $data['proof_image'] = 'assets/vendor/proofs/' . $proofImageName;
        }

        if ($request->hasFile('gstin_image')) {
            $gstinImage = $request->file('gstin_image');
            $gstinImageName = time() . '_' . $gstinImage->getClientOriginalName();
            $gstinImage->move(public_path('assets/vendor/proofs'), $gstinImageName);
            $data['gstin_image'] = 'assets/vendor/proofs/' . $gstinImageName;
        }


        VendorProfile::updateOrCreate(['vendor_id' => auth()->id()], $data);

        return response()->json([
            'status' => true,
            'message' => 'Vendor profile updated successfully'
        ], 200);
    }

    public function orderAccept($id)
    {
        $order = OrderItem::find($id);

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Order item not found.'
            ], 200);
        }

        // Fetch product
        $product = Product::find($order->product_id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found.'
            ], 200);
        }

        // Update ordered quantity
        $product->order_qty += $order->quantity;

        if ($order->seller_id == 1) {
            // Admin stock handling
            if ($product->quantity <= $product->order_qty) {
                $product->stock_status = 'outofstock';
            }
            $product->save();
        } else {
            // Vendor stock handling
            $vproduct = VendorProduct::where('product_id', $order->product_id)
                ->where('vendor_id', $order->seller_id)
                ->first();

            if (!$vproduct) {
                return response()->json([
                    'status' => false,
                    'message' => 'Vendor product not found.'
                ], 200);
            }

            if ($vproduct->quantity <= $order->quantity) {
                $vproduct->stock_status = 'outofstock';
                $vproduct->quantity = 0;
            } else {
                $vproduct->quantity -= $order->quantity;
            }

            $vproduct->save();
        }

        // Update order item status
        $order->status = 'accepted';
        $order->save();

        // Record product history
        ProductHistory::create([
            'seller_id' => $order->seller_id,
            'product_id' => $order->product_id,
            'order_id' => $order->id,
            'type' => 'minus',
            'quantity' => $order->quantity,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Order Accepted!'
        ], 200);
    }

    public function orderReject($id)
    {
        $order = OrderItem::where('id', $id)->first();

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Order item not found.'
            ], 200);
        }

        $order->status = 'rejected';
        $order->save();

        return response()->json([
            'status' => true,
            'message' => 'Order Rejected!'
        ], 200);
    }
    public function addQuantity(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'quantity' => 'required',
        ]);

        $vendorProduct = VendorProduct::find($request->id);
        $vendorProduct->quantity += $request->quantity;
        $vendorProduct->save();

        ProductHistory::create([
            'seller_id' => $vendorProduct->vendor_id,
            'product_id' => $vendorProduct->product_id,
            'type' => 'add',
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'quantity added successfully!'
        ], 200);
    }
    public function productOrderHistory(Request $request)
    {
        $vendorProducts = VendorProduct::with('productApi')->where('vendor_id', auth()->id())->get();

        $vendorProducts->map(function ($product) {
            $product->totalMinus = ProductHistory::where('seller_id', $product->vendor_id)
                ->where('product_id', $product->product_id)
                ->where('type', 'minus')
                ->sum('quantity');

            $product->totalAdd = ProductHistory::where('seller_id', $product->vendor_id)
                ->where('product_id', $product->product_id)
                ->where('type', 'add')
                ->sum('quantity');

            return $product;
        });

        return response()->json([
            'status' => true,
            'result' => $vendorProducts
        ], 200);
    }


    public function productHistory($id)
    {
        $productHistory = ProductHistory::where('product_id', $id)->orderByDesc('id')->get();

        $productHistory->map(function ($product) {
            $orderItem = OrderItem::find($product->order_id);
            $product->order_number = isset($orderItem) ? $orderItem->order->order_number : null;

            return $product;
        });

        return response()->json([
            'status' => true,
            'result' => $productHistory
        ], 200);
    }
}
