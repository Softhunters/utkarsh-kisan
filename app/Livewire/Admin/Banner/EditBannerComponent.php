<?php

namespace App\Livewire\Admin\Banner;

use Livewire\Component;
use App\Models\Banner;
use App\Models\Category;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class EditBannerComponent extends Component
{
    use WithFileUPloads;
    public $title;
    public $link;
    public $images;
    public $status;
    public $for;
    public $newimages;
    public $b_id;

    public  function mount($bid)
     {
        $slider = Banner::find($bid);
        $this->title = $slider->title;
        $this->link=$slider->link;
        $this->images = $slider->images;
    
        $this->status=$slider->status;
        $this->for = $slider->for;
        $this->b_id = $slider->id;
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
      public function updateBanner()
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
      
        $slider = Banner::find($this->b_id);
        $slider->title = $this->title;
        $slider->link = $this->link;
        $slider->status = $this->status;
        $slider->for = $this->for;
        if($this->newimages)
        {
            if($slider->images)
            {
                $imagesd = $slider->images;
               
                    if($imagesd)
                    {
                       // unlink('admin/banner'.'/'.$imagesd);
                    }
                
            }
            $imagesname = '';
            if($this->newimages)
            {
                $imgName = Carbon::now()->timestamp.'.'.$this->newimages->extension();
                $this->newimages->storeAs('banner',$imgName);
                $imagesname = $imgName;
                $slider->images = $imagesname;
            }
            
        }

        $slider->save();
        Session()->flash('message','Banner has been Updated Successfully!');
    }
    public function render()
    {
        $categorys =  Category::where('status', 1)->where('is_home', 1)->where('status', '!=', 3)->get();
        return view('livewire.admin.banner.edit-banner-component',['categorys'=>$categorys])->layout('layouts.admin');
    }
}
