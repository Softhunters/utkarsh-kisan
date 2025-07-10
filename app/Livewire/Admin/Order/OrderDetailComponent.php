<?php

namespace App\Livewire\Admin\Order;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class OrderDetailComponent extends Component
{
    public function  mount($id)
    {
        $this->order_id = $id;

    }
    public function render()
    {
        $order = Order::where('id',$this->order_id)->first();
        $orderitems = OrderItem::with('seller')->where('order_id',$order->id)->get();
        return view('livewire.admin.order.order-detail-component',['order'=>$order,'orderitems'=>$orderitems])->layout('layouts.admin');
    }
}
