<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
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
            'quantity' => 'required|integer|min:1',
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
}
