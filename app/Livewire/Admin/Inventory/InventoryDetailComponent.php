<?php

namespace App\Livewire\Admin\Inventory;

use App\Models\Product;
use Livewire\Component;

class InventoryDetailComponent extends Component
{
    public $product_id;
    public function mount($id)
    {
        $this->product_id = $id;
    }
    public function render()
    {
        $product = Product::with(['productHistories.seller', 'productHistories.orderItem'])
            ->where('id', $this->product_id)
            ->first();

        return view('livewire.admin.inventory.inventory-detail-component', compact('product'))->layout('layouts.admin');
    }

}
