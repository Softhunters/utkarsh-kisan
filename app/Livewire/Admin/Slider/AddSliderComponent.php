<?php

namespace App\Livewire\Admin\Slider;

use Livewire\Component;
use App\Models\Slider;
use App\Models\Category;
use Livewire\WithFileUploads;
use Carbon\Carbon;


class AddSliderComponent extends Component
{
    use WithFileUPloads;
    public $title;
    public $link;
    public $images;
    public $status;
    public $for;

     public  function mount()
     {
        $this->status = 1;
        $this->for = 'home';
     } 

     public function updated($fields)
    {
        $this->validateOnly($fields,[
            'title' => 'required',
            'link' => 'required',
            'images'=>'required|mimes:jpeg,jpg,png',
            'for'=>'required',
            'status'=>'required',
            
        ]);
    }

     public function addSlider()
     {
        $this->validate([
            'title' => 'required',
            'link' => 'required',
            'images'=>'required|mimes:jpeg,jpg,png',
            'for'=>'required',
            'status'=>'required',
        ]);
        $slider = new Slider();
        $slider->title = $this->title;
        $slider->link = $this->link;
        $slider->status = $this->status;
        $slider->for = $this->for;
        if($this->images)
        {
         
            $imgName = Carbon::now()->timestamp.'.'.$this->images->extension();
            $this->images->storeAs('slider',$imgName);
            $imagesname = $imgName;
            $slider->images = $imagesname;
        }

        $slider->save();
        Session()->flash('message','Slider has been Created Successfully!');
     }
    public function render()
    {
        $categorys =  Category::all();
        return view('livewire.admin.slider.add-slider-component',['categorys'=>$categorys])->layout('layouts.admin');
    }
}
