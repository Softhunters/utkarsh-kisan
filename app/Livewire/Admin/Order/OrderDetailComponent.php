<?php

namespace App\Livewire\Admin\Order;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductHistory;
use App\Models\VendorProduct;
use DB;
use Livewire\Component;

class OrderDetailComponent extends Component
{
    public $order_id;
    public function mount($id)
    {
        $this->order_id = $id;

    }

    public function updateOrderStatus($order_item_id, $status)
    {
        $order = OrderItem::find($order_item_id);

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Order item not found.'
            ], 200);
        }

        $order->status = $status;
        if ($status == "delivered") {
            $order->delivered_date = DB::raw('CURRENT_DATE');
            $order->rstatus = '3';
        } else if ($status == "canceled") {
            $order->canceled_date = DB::raw('CURRENT_DATE');
            $order->rstatus = '1';
            $product = Product::find($order->product_id);
            $product->order_qty = $product->order_qty - $order->quantity;
            if ($product->quantity <= ($product->order_qty - $order->quantity)) {
                $product->stock_status = "outofstock";
            }
            $product->save();
        } else if ($status == "accepted") {



            // Fetch product
            $product = Product::find($order->product_id);

            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found.'
                ], 200);
            }

            // Update ordered quantity
            $product->order_qty += $order->quantity;

            if ($order->seller_id == 1) {
                // Admin stock handling
                if ($product->quantity <= $product->order_qty) {
                    $product->stock_status = 'outofstock';
                }
                $product->save();
            } else {
                // Vendor stock handling
                $vproduct = VendorProduct::where('product_id', $order->product_id)
                    ->where('vendor_id', $order->seller_id)
                    ->first();

                if (!$vproduct) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Vendor product not found.'
                    ], 200);
                }

                if ($vproduct->quantity <= $order->quantity) {
                    $vproduct->stock_status = 'outofstock';
                    $vproduct->quantity = 0;
                } else {
                    $vproduct->quantity -= $order->quantity;
                }

                $vproduct->save();
            }

            // Record product history
            ProductHistory::create([
                'seller_id' => $order->seller_id,
                'product_id' => $order->product_id,
                'order_id' => $order->id,
                'type' => 'minus',
                'quantity' => $order->quantity,
            ]);

            // $this->mkeorderapisd($order_id);
        } else if ($status == "rejected") {
            $order->canceled_date = DB::raw('CURRENT_DATE');
            $order->rstatus = '1';
        }

        $order->save();
        session()->flash('order_message', 'Order Item status has been updated Successfully!');
    }
    public function render()
    {
        $order = Order::where('id', $this->order_id)->first();
        $orderitems = OrderItem::with('seller')->where('order_id', $order->id)->get();
        return view('livewire.admin.order.order-detail-component', ['order' => $order, 'orderitems' => $orderitems])->layout('layouts.admin');
    }
}
