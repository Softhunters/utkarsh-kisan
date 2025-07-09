<?php

namespace App\Livewire\Frontend;

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

    public function  mount($id)
    {
        $this->order_id = $id;

    }
    public function preview($id){

        $product=Product::where('id',$id)->first();
        $this->pid=$id;
        $this->pname=$product->name;
        $this->dispatch('openproductPreviewModal');
    }
    
    public function storeReview(){
        $this->validate([
            'message'=>'required',
            'rating'=>'required',
            'images'=>'required',
        ]);
// dd($this->rating);
        $review =new review();
        $review->product_id=$this->pid;
        $review->user_id=Auth::id();
        $review->message= $this->message;
        $review->rating= $this->rating;
        if($this->images)
        {
            $imagesname = '';
            foreach($this->images as $key=>$image)
            {
                $imgName = Carbon::now()->timestamp. $key.'.'.$image->extension();
                $image->storeAs('review',$imgName);
                $imagesname = $imagesname.','.$imgName;
            }
            // dd($imagesname);
            $review->images = $imagesname;
        }
        $review->save();
        Session()->flash('message','Review has been Submited Successfully');
    }
    public function render()
    {
        $order = Order::where('id',$this->order_id)->first();
        $orderitems = OrderItem::where('order_id',$order->id)->get();
//dd($orderitems);
        return view('livewire.frontend.order-details-component',['order'=>$order,'orderitems'=>$orderitems])->layout('layouts.main');
    }
}
