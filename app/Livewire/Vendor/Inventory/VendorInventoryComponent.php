<?php

namespace App\Livewire\Vendor\Inventory;

use App\Models\Product;
use Auth;
use Livewire\Component;

class VendorInventoryComponent extends Component
{
    public function render()
    {
        $products = Product::with([
            'activeVendorProducts',
        ])
            ->whereHas('activeVendorProducts', function ($query)  {
                $query->where('vendor_id', Auth::id());
            })
            ->get();

        $inventories = $products->map(function ($product) {
            $totalAdded = $product->productHistories->where('type', 'add')->sum('quantity');
            $totalSpent = $product->productHistories->where('type', 'minus')->sum('quantity');
            $available = $totalAdded - $totalSpent;

            return [
                'id' => $product->id,
                'name' => $product->name,
                'total_add' => $totalAdded,
                'total_spent' => $totalSpent,
                'available' => $available,
            ];
        });
        return view('livewire.vendor.inventory.vendor-inventory-component', compact('inventories'))->layout('layouts.vendor1');
    }
}
