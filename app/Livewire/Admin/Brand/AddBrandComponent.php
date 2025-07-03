<?php

namespace App\Livewire\Admin\Brand;

use Livewire\Component;
use App\Models\Brand;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class AddBrandComponent extends Component
{
    use WithFileUPloads;
    public $brand_name;
    public $brand_slug;
    public $description;
    public $brand_image;
    public $status;
    public $is_home;
    
    // public function mount()
    // {
    //     $this->status = 1;
    //     $this->is_home = 0;                            
                                                        
    // }
    public function generateSlug()
    {
        $this->brand_slug = Str::slug($this->brand_name,'-');
    }
    public function updated($fields)
    {
        $this->validateonly($fields,[
             'brand_name'=>'required',
             'brand_slug'=>'required|unique:brands',
             'description'=>'required',
             'brand_image'=>'required||mimes:jpeg,jpg,png',
             'status'=>'required',
             'is_home'=>'required',
        ]);
    }
    public function storeBrand()
    {
        $this->validate([
            'brand_name'=>'required',
             'brand_slug'=>'required|unique:brands',
             'description'=>'required',
             'brand_image'=>'required||mimes:jpeg,jpg,png',
             'status'=>'required',
             'is_home'=>'required',
        ]);

        $brand =new Brand();
        $brand->brand_name= $this->brand_name;
        $brand->brand_slug= $this->brand_slug;
        $brand->description= $this->description;
        if($this->brand_image){
        $imageName= Carbon::now()->timestamp.'.'.$this->brand_image->extension();
        $this->brand_image->storeAs('brand',$imageName);
        $brand->brand_image = $imageName;
        }
        $brand->status= $this->status;
        $brand->is_home= $this->is_home;
        $brand->save();
        Session()->flash('message','Brand has been Created Successfully!');
    }
    public function render()
    {
        return view('livewire.admin.brand.add-brand-component')->layout('layouts.admin');
    }
}
