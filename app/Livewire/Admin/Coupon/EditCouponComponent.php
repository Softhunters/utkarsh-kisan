<?php

namespace App\Livewire\Admin\Coupon;

use Livewire\Component;
use App\Models\Coupon;
use App\Models\Category;

class EditCouponComponent extends Component
{
    public $coupon_name;
    public $code;
    public $type;
    public $value;
    public $category_id;
    public $cart_value;
    public $status;
    public $c_id;

    public function mount($cid)
    {
        $coupon =Coupon::find($cid);
        $this->coupon_name = $coupon->coupon_name;
        $this->code = $coupon->code;
        $this->value = $coupon->value;
        $this->type = $coupon->type;
        $this->category_id = $coupon->category_id;
        $this->cart_value = $coupon->cart_value;
        $this->status = $coupon->status;
        $this->c_id = $coupon->id;
    }
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'coupon_name' => 'required',
            'type'=>'required',
            'value'=>'required|numeric',
            'status'=>'required',
            'code' => 'required|unique:coupons,code,'.$this->c_id
            
        ]);
    }

    public function updateCoupon()
    {
        $this->validate([
            'coupon_name' => 'required',
            'type'=>'required',
            'value'=>'required|numeric',
            'status'=>'required',
            'code' => 'required|unique:coupons,code,'.$this->c_id
            
        ]);
        $coupon =  Coupon::find($this->c_id);
        $coupon->coupon_name = $this->coupon_name;
        $coupon->code = $this->code; 
        $coupon->type = $this->type;
        $coupon->value = $this->value;
        $coupon->category_id = $this->category_id;
        $coupon->cart_value = $this->cart_value;
        $coupon->status = $this->status;
        $coupon->save();
        Session()->flash('message','Coupon has been Updated Successfully!');
    }
    public function render()
    {
        $categorys = Category::where('status', 1)->where('is_home', 1)->where('status', '!=', 3)->get();
        return view('livewire.admin.coupon.edit-coupon-component',['categorys'=>$categorys])->layout('layouts.admin');
    }
}
