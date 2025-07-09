<?php

namespace App\Livewire\Admin\Slider;

use Livewire\Component;
use App\Models\Slider;
use App\Models\Category;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class EditSliderComponent extends Component
{
    use WithFileUPloads;
    public $title;
    public $link;
    public $images;
    public $status;
    public $for;
    public $newimages;
    public $s_id;

     public  function mount($sid)
     {
        $slider = Slider::find($sid);
        $this->title = $slider->title;
        $this->link=$slider->link;
        $this->images = $slider->images;
    
        $this->status=$slider->status;
        $this->for = $slider->for;
        $this->s_id = $slider->id;
       // dd($this->for);
     } 

     public function updated($fields)
    {
        $this->validateOnly($fields,[
            'title' => 'required',
            'link' => 'required',
            
            'for'=>'required',
            'status'=>'required',
            
        ]);

        if($this->newimages){
            $this->validateOnly($fields,[
                'newimages'=>'required|mimes:jpeg,jpg,png'
            ]);
        }
    }
      public function updateSlider()
      {
        $this->validate([
            'title' => 'required',
            'link' => 'required',
            
            'for'=>'required',
            'status'=>'required',
            
        ]);

        if($this->newimages){
            $this->validate([
                'newimages'=>'required|mimes:jpeg,jpg,png'
            ]);
        }
    
        $slider = Slider::find($this->s_id);
        $slider->title = $this->title;
        $slider->link = $this->link;
        $slider->status = $this->status;
        $slider->for = $this->for;
        if($this->newimages)
        {
            if($slider->images)
            {
                // unlink('admin/slider'.'/'.$slider->images);  
            }
            
            $imgName = Carbon::now()->timestamp.'.'.$this->newimages->extension();
            $this->newimages->storeAs('slider',$imgName);
            $imagesname = $imgName;
            $slider->images = $imagesname;
        }

        $slider->save();
        Session()->flash('message','Slider has been Updated Successfully!');

      }
    public function render()
    {
        $categorys =  Category::where('status', 1)->where('is_home', 1)->where('status', '!=', 3)->get();
        return view('livewire.admin.slider.edit-slider-component',['categorys'=>$categorys])->layout('layouts.admin');
    }
}
