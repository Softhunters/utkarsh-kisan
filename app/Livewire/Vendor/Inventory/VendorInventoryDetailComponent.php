<?php

namespace App\Livewire\Vendor\Inventory;

use App\Models\Product;
use Livewire\Component;

class VendorInventoryDetailComponent extends Component
{
    public $product_id;
    public function mount($id)
    {
        $this->product_id = $id;
    }
    public function render()
    {
        $product = Product::with([
            'productHistories' => function ($q) {
                $q->where('seller_id', auth()->id());
            },
            'productHistories.seller',
            'productHistories.orderItem'
        ])
            ->where('id', $this->product_id)
            ->first();

        return view('livewire.vendor.inventory.vendor-inventory-detail-component', compact('product'))->layout('layouts.vendor1');
    }
}
