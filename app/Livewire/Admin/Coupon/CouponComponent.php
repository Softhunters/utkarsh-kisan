<?php

namespace App\Livewire\Admin\Coupon;

use Livewire\Component;
use App\Models\Coupon;

class CouponComponent extends Component
{
    public function DeactiveCoupon($id)
    {
        $category = Coupon::find($id);
        $category->status=0;
        $category->save();
        session()->flash('message','Coupon has been Deactive successfully!');
        $this->js('window.location.reload()');
    }
    public function ActiveCoupon($id)
    {
        $category = Coupon::find($id);
        $category->status=1;
        $category->save();
        session()->flash('message','Coupon has been Active successfully!');
        $this->js('window.location.reload()');
    }
    public function deleteCoupon($id)
    {
        $category = Coupon::find($id);
        $category->status=3;
        $category->save();
        session()->flash('message','Coupon has been deleted successfully!');
        $this->js('window.location.reload()');
    }
    public function render()
    {
        $coupons =Coupon::where('status','!=',3)->get();
        return view('livewire.admin.coupon.coupon-component',['coupons'=>$coupons])->layout('layouts.admin');
    }
}
