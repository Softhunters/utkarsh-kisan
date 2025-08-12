<?php

namespace App\Livewire\Vendor\Inventory;

use App\Models\Product;
use App\Models\ProductHistory;
use App\Models\VendorProduct;
use Auth;
use Livewire\Component;
use Str;

class VendorInventoryComponent extends Component
{
    public function render()
    {
        $vendorId = Auth::id();

        $products = VendorProduct::with(['product'])->where('vendor_id', $vendorId)->get();

        // $products = Product::with([
        //     'activeVendorProducts' => fn($q) => $q->where('vendor_id', $vendorId),
        //     'productHistories' => fn($q) => $q->where('seller_id', $vendorId),
        // ])
        //     ->whereHas('activeVendorProducts', fn($q) => $q->where('vendor_id', $vendorId))
        //     ->get();
// dd($products);
        $inventories = $products->map(function ($vproduct) use ($vendorId) {
            // $histories = $product->productHistories;
            $histories = ProductHistory::where('seller_id', $vendorId)->where('product_id', $vproduct->product_id)->get();

            $totalAdded = $histories->where('type', 'add')->sum('quantity');
            $totalSpent = $histories->where('type', 'minus')->sum('quantity');
            $available = $totalAdded - $totalSpent;

            // // Get this vendor's price from activeVendorProducts
            $vendorPrice = $vproduct->price;
            // $vendorId = optional($product->activeVendorProducts->first())->vendor_id;

            return [
                'id' => $vproduct->product->id,
                'name' => Str::limit($vproduct->product->name, 60),
                'slug' => $vproduct->product->slug,
                'price' => $vendorPrice,
                'total_add' => $totalAdded,
                'total_spent' => $totalSpent,
                'available' => $available,
                'vendor_id' => $vendorId,
            ];
        });
        return view('livewire.vendor.inventory.vendor-inventory-component', compact('inventories'))->layout('layouts.vendor1');
    }
}
