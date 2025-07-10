<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class VendorOrderComponentDetail extends Component
{
    public function mount($id)
    {
        $this->order_id = $id;

    }
    public function render()
    {
        $order = Order::where('id', $this->order_id)->first();
        $orderitems = OrderItem::with('seller')
            ->where('order_id', $order->id)
            ->get();

        $mappedItems = $orderitems->map(function ($item) {
            $subtotal = $item->price * $item->quantity;
            $gst_percent = $item->gst ?? 0;
            $gst_amount = ($subtotal * $gst_percent) / 100;
            $total = $subtotal + $gst_amount;


            $item->product_name = $item->product->name;
            $item->image = $item->product->image;
            $item->slug = $item->product->slug;
            $item->subtotal = round($subtotal, 2);
            $item->gst_percent = $gst_percent;
            $item->gst_amount = round($gst_amount, 2);
            $item->total = round($total, 2);
            $item->shipping = 0;
            $item->discount = 0;

            return $item;

        });

        $finalSubtotal = $mappedItems->sum('subtotal');
        $finalTotal = $mappedItems->sum('total');

        $orderitems = $mappedItems;
        $subtotal = round($finalSubtotal, 2);
        $total = round($finalTotal, 2);
        $shipping = 0;
        $discount = 0;
    
        return view('livewire.admin.order.vendor-order-component-detail', ['order' => $order, 'orderitems' => $orderitems, 'subtotal' => $subtotal, 'total' => $total, 'shipping' => $shipping, 'discount' => $discount])->layout('layouts.vendor1');
    }

}
