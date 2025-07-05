<?php

namespace App\Livewire\Admin\Banner;

use Livewire\Component;
use App\Models\Banner;
use App\Models\Category;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class AddBannerComponent extends Component
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
     public function addBanner()
     {
        $this->validate([
            'title' => 'required',
            'link' => 'required',
            'images'=>'required|mimes:jpeg,jpg,png',
            'for'=>'required',
            'status'=>'required',        
        ]);
            
        $slider = new Banner();
        $slider->title = $this->title;
        $slider->link = $this->link;
        $slider->status = $this->status;
        $slider->for = $this->for;
        if($this->images)
        {
           
                $imgName = Carbon::now()->timestamp.'.'.$this->images->extension();
                $this->images->storeAs('banner',$imgName);
                $imagesname = $imgName;
            
            $slider->images = $imagesname;
        }

        $slider->save();
        Session()->flash('message','Banner has been Created Successfully!');
     }

    public function render()
    {
        $categorys =  Category::all();
        return view('livewire.admin.banner.add-banner-component',['categorys'=>$categorys])->layout('layouts.admin');
    }
}
