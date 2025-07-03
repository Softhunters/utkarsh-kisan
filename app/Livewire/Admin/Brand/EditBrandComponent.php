<?php

namespace App\Livewire\Admin\Brand;

use Livewire\Component;
use App\Models\Brand;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class EditBrandComponent extends Component
{
    use WithFileUPloads;
    public $brand_name;
    public $brand_slug;
    public $description;
    public $brand_image;
    public $status;
    public $is_home;

    public $newimage;
    public $brand_id;

    public function mount($br_id)
    {
        $brand = Brand::find($br_id);
        $this->brand_id = $brand->id;
        $this->brand_name= $brand->brand_name;
        $this->brand_slug= $brand->brand_slug;
        $this->description= $brand->description;
        $this->status= $brand->status;
        $this->is_home= $brand->is_home;
        $this->brand_image = $brand->brand_image;
    }
    public function generateSlug()
    {
        $this->brand_slug = Str::slug($this->brand_name,'-');
    }
    public function updated($fields)
    {
        $this->validateonly($fields,[
             'brand_name'=>'required',
             'description'=>'required',
             'status'=>'required',
             'is_home'=>'required',
             'brand_slug' => 'required|unique:brands,brand_slug,'.$this->brand_id

        ]);
        if($this->newimage)
        {
            $this->validateOnly($fields,[
                'newimage'=>'required|mimes:jpeg,jpg,png',
            ]);
        }
    }

    public function updateBrand()
    {
        $this->validate([
            'brand_name'=>'required',
            'description'=>'required',
             'status'=>'required',
            'is_home'=>'required',
            'brand_slug' => 'required|unique:brands,brand_slug,'.$this->brand_id
        ]);

        if($this->newimage)
        {
            $this->validate([
                'newimage'=>'required|mimes:jpeg,jpg,png',
            ]);
        }

        $brand = Brand::find($this->brand_id);
        
        $brand->brand_name= $this->brand_name;
        $brand->brand_slug= $this->brand_slug;
        $brand->description= $this->description;
        $brand->status= $this->status;
        $brand->is_home= $this->is_home;
        if($this->newimage){
            unlink('admin/brand'.'/'.$brand->brand_image);
            $imageName= Carbon::now()->timestamp.'.'.$this->newimage->extension();
            $this->newimage->storeAs('brand',$imageName);
            $brand->brand_image = $imageName;
        }
        $brand->save();
        session()->flash('message','Brand has been upadted successfully !');
    }
    public function render()
    {
        return view('livewire.admin.brand.edit-brand-component')->layout('layouts.admin');
    }
}
