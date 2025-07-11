<?php

namespace App\Livewire\Frontend;

use DB;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\review;
use Carbon\Carbon;
use Livewire\WithFileUploads;


class OrderDetailsComponent extends Component
{
    use WithFileUploads;

    public $order_id;
    public $pname;
    public $pid;
    public $message;
    public $images;
    public $rating;

    public function mount($id)
    {
        $this->order_id = $id;

    }

    public function cancelOrder()
    {
        $order = Order::find($this->order_id);
        $order->status = "canceled";
        $order->canceled_date = DB::raw('CURRENT_DATE');
        $order->save();
        session()->flash('warning', 'Order has been canceled!');
    }
    public function cancelOrderItem($id)
    {
        $orderItem = OrderItem::find($id);
        $orderItem->rstatus = 1;
        $orderItem->canceled_date = DB::raw('CURRENT_DATE');
        $orderItem->save();
        $order_canceled = OrderItem::where('order_id', $orderItem->order_id)->where('rstatus', '!=', 1)->count();
        // dd($order_canceled);
        if ($order_canceled == 0) {
            $rfg = Order::find($orderItem->order_id);
            $rfg->status = 'canceled';
            $rfg->canceled_date = DB::raw('CURRENT_DATE');
            $rfg->save();
        }
        session()->flash('warning', 'Order Item has been canceled!');
    }

    public function preview($id)
    {

        $product = Product::where('id', $id)->first();
        $this->pid = $id;
        $this->pname = $product->name;
        $this->dispatch('openproductPreviewModal');
    }

    public function storeReview()
    {
        $this->validate([
            'message' => 'required',
            'rating' => 'required',
            'images' => 'required',
        ]);
        // dd($this->rating);
        $review = new review();
        $review->product_id = $this->pid;
        $review->user_id = Auth::id();
        $review->message = $this->message;
        $review->rating = $this->rating;
        if ($this->images) {
            $imagesname = '';
            foreach ($this->images as $key => $image) {
                $imgName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs('review', $imgName);
                $imagesname = $imagesname . ',' . $imgName;
            }
            // dd($imagesname);
            $review->images = $imagesname;
        }
        $review->save();
        Session()->flash('message', 'Review has been Submited Successfully');
    }
    public function render()
    {
        $order = Order::where('id', $this->order_id)->first();
        $orderitems = OrderItem::where('order_id', $order->id)->get();
        //dd($orderitems);
        return view('livewire.frontend.order-details-component', ['order' => $order, 'orderitems' => $orderitems])->layout('layouts.main');
    }
}
