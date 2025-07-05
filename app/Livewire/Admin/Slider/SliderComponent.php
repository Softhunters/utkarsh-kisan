<?php

namespace App\Livewire\Admin\Slider;

use Livewire\Component;
use App\Models\Slider;

class SliderComponent extends Component
{
    public function DeactiveSlider($id)
    {
        $category = Slider::find($id);
        $category->status=0;
        $category->save();
        session()->flash('message','Slider has been Deactive successfully!');
        $this->js('window.location.reload()');
    }
    public function ActiveSlider($id)
    {
        $category = Slider::find($id);
        $category->status=1;
        $category->save();
        session()->flash('message','Slider has been Active successfully!');
        $this->js('window.location.reload()');
    }
    public function deleteSlider($id)
    {
        $category = Slider::find($id);
        $category->status=3;
        $category->save();
        session()->flash('message','Slider has been deleted successfully!');
        $this->js('window.location.reload()');
    }
    public function render()
    {
        $sliders = Slider::where('status','!=',3)->get();
        return view('livewire.admin.slider.slider-component',['sliders'=>$sliders])->layout('layouts.admin');
    }
}
