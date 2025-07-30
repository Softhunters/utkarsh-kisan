<?php

namespace App\Livewire\Vendor\Inventory;

use App\Models\Product;
use Auth;
use Livewire\Component;
use Str;

class VendorInventoryComponent extends Component
{
    public function render()
    {
        $vendorId = Auth::id();

        $products = Product::with([
            'activeVendorProducts' => fn($q) => $q->where('vendor_id', $vendorId),
            'productHistories' => fn($q) => $q->where('seller_id', $vendorId),
        ])
            ->whereHas('activeVendorProducts', fn($q) => $q->where('vendor_id', $vendorId))
            ->get();

        $inventories = $products->map(function ($product) use ($vendorId) {
            $histories = $product->productHistories;

            $totalAdded = $histories->where('type', 'add')->sum('quantity');
            $totalSpent = $histories->where('type', 'minus')->sum('quantity');
            $available = $totalAdded - $totalSpent;

            // Get this vendor's price from activeVendorProducts
            $vendorPrice = optional($product->activeVendorProducts->first())->price;
            $vendorId = optional($product->activeVendorProducts->first())->vendor_id;

            return [
                'id' => $product->id,
                'name' => Str::limit($product->name, 60),
                'slug' => $product->slug,
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
