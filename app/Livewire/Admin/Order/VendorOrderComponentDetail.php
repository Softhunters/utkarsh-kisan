<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductHistory;
use App\Models\VendorProduct;
use DB;
use Livewire\Component;

class VendorOrderComponentDetail extends Component
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
        // dd($this->order_id);
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
