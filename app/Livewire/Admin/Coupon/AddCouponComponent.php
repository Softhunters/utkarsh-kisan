<?php

namespace App\Livewire\Admin\Coupon;

use Livewire\Component;
use App\Models\Coupon;
use App\Models\Category;

class AddCouponComponent extends Component
{
    public $coupon_name;
    public $code;
    public $type;
    public $value;
    public $category_id;
    public $cart_value;
    public $status;

    // public function mount()
    // {
    //     $this->status = 1;
    //     $this->type = 1;
    // }
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'coupon_name' => 'required',
            'code' => 'required|unique:coupons',
            'type'=>'required',
            'value'=>'required|numeric',
            'status'=>'required',
            
        ]);
    }

    public function addCoupon()
    {
        $this->validate([
            'coupon_name' => 'required',
            'code' => 'required|unique:coupons',
            'type'=>'required',
            'value'=>'required|numeric',
            'status'=>'required',
        ]);
        $coupon = new Coupon();
        $coupon->coupon_name = $this->coupon_name;
        $coupon->code = $this->code; 
        $coupon->type = $this->type;
        $coupon->value = $this->value;
        $coupon->category_id = $this->category_id;
        $coupon->cart_value = $this->cart_value;
        $coupon->status = $this->status;
        $coupon->save();
        Session()->flash('message','Coupon has been Created Successfully!');
    }
    public function render()
    {
        $categorys = Category::where('status', 1)->where('is_home', 1)->where('status', '!=', 3)->get();
        return view('livewire.admin.coupon.add-coupon-component',['categorys'=>$categorys])->layout('layouts.admin');
    }
}
