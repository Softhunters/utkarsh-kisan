<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product2;
use App\Models\SubCategory;
use App\Models\VendorProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnArgument;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = VendorProduct::where('vendor_id', auth()->id())->get();

        return view('vendor.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', '!=', 3)->get();
        $brands = Brand::where('status', '!=', 3)->get();
        return view('vendor.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:product2s,id',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|integer|min:1',
            'additional_info' => 'nullable|string',
        ]);

        // Create Vendor Product
        $vendorProduct = new VendorProduct();
        $vendorProduct->product_id = $request->product_id;
        $vendorProduct->vendor_id = Auth::id();
        $vendorProduct->price = $request->price;
        $vendorProduct->quantity = $request->quantity;
        $vendorProduct->additional_info = $request->additional_info ?? null;
        $vendorProduct->save();

        return redirect()->back()->with('message', 'Product added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vendorProduct = VendorProduct::where('vendor_id', auth()->id())->findOrFail($id);
        $categories = Category::where('status', '!=', 3)->get();
        $brands = Brand::where('status', '!=', 3)->get();
        return view('vendor.product.edit', compact('vendorProduct', 'categories', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $product = VendorProduct::where('vendor_id', auth()->id())->findOrFail($id);

        $request->validate([
            'product_id' => 'required|exists:product2s,id',
            'price' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1',
        ]);

        $product->update([
            'product_id' => $request->product_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'additional_info' => $request->additional_info,
        ]);

        return redirect()->route('vendor.products')->with('message', 'Product updated successfully.');
    }

    public function show($id)
    {
        $vendorProduct = VendorProduct::with('product')->where('vendor_id', auth()->id())->findOrFail($id);
        return view('vendor.product.show', compact('vendorProduct'));
    }

    public function destroy($id)
    {
        $product = VendorProduct::where('vendor_id', auth()->id())->findOrFail($id);
        $product->delete();
        return redirect()->route('vendor.products')->with('message', 'Product deleted.');
    }

    public function getSubcategories($categoryId)
    {
        return SubCategory::where('category_id', $categoryId)->where('status', '!=', 3)->get(['id', 'name']);
    }

    public function toggleStatus($id)
    {
        $product = VendorProduct::findOrFail($id);
        $product->status = $product->status == 1 ? 0 : 1;
        $product->save();

        return redirect()->back()->with('message', 'Product status updated successfully.');
    }


    public function getProducts(Request $request)
    {
        return Product2::where('category_id', $request->category_id)
            ->where('subcategory_id', $request->subcategory_id)
            ->when($request->brand_id, fn($q) => $q->where('brand_id', $request->brand_id))
            ->where('status', 1)
            ->get(['id', 'name']);
    }

}
