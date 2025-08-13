<?php

namespace App\Livewire\Admin\Inventory;

use App\Models\Product;
use Livewire\Component;

class InventoryComponent extends Component
{
    
    public function render()
    {
        $products = Product::with([
            'activeVendorProducts',
            'productHistories'
        ])
            ->whereHas('activeVendorProducts')
            ->get();

        $inventories = $products->map(function ($product) {
            $totalAdded = $product->productHistories->where('type', 'add')->sum('quantity');
            $totalSpent = $product->productHistories->where('type', 'minus')->sum('quantity');
            $available = $totalAdded - $totalSpent;
            $vendorId = optional($product->activeVendorProducts->first())->vendor_id;

            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->sale_price,
                'slug' => $product->slug,
                'total_add' => $totalAdded,
                'total_spent' => $totalSpent,
                'available' => $available,
                'histories' => $product->productHistories,
                'vendor_id' => $vendorId,
            ];
        });
        return view('livewire.admin.inventory.inventory-component', compact('inventories'))->layout('layouts.admin');
    }
}
