<?php

namespace App\Livewire\Admin\Banner;

use Livewire\Component;
use App\Models\Banner;
class BannerComponent extends Component
{
    public function DeactiveBanner($id)
    {
        $category = Banner::find($id);
        $category->status=0;
        $category->save();
        session()->flash('message','Banner has been Deactive successfully!');
        $this->js('window.location.reload()');
    }
    public function ActiveBanner($id)
    {
        $category = Banner::find($id);
        $category->status=1;
        $category->save();
        session()->flash('message','Banner has been Active successfully!');
        $this->js('window.location.reload()');
    }
    public function deleteBanner($id)
    {
        $category = Banner::find($id);
        $category->status=3;
        $category->save();
        session()->flash('message','Banner has been deleted successfully!');
        $this->js('window.location.reload()');
    }
    public function render()
    {
        $sliders = Banner::where('status','!=',3)->get();
        return view('livewire.admin.banner.banner-component',['sliders'=>$sliders])->layout('layouts.admin');
    }
}
