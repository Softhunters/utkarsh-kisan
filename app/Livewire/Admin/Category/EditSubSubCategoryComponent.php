<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use App\Models\SubSubCategory;

class EditSubSubCategoryComponent extends Component
{
    use WithFileUPloads;
    public $category_slug;
    public $category_id;
    public $name;
    public $slug;
    public $scategory_id;
    public $scategory_slug;
    public $icon;
    public $categorythum;
    public $newimage;
    public $newicon;
    public $subcategory_id;
    public $is_home;

    public function mount($scategory_slug)
    {
        //dd($scategory_slug);
       
            $this->scategory_slug = $scategory_slug;
            $scategory = SubSubCategory::where('slug',$scategory_slug)->first();
            $this->scategory_id = $scategory->sub_category_id;
            $this->category_id =  $scategory->category_id;
            $this->name = $scategory->name;
            $this->slug = $scategory->slug;
            $this->icon = $scategory->icon;
            $this->categorythum = $scategory->categorythum;
            $this->is_home = $scategory->is_home;
            $this->subcategory_id = $scategory->id;
            //dd($this->slug);
        
    }


    public function generateslug()
    {
        $this->slug = Str::slug($this->name);
    }
    
    public function updated($fields)
    {
        if($this->newimage)
        {
            $this->validateOnly($fields,[
                'newimage'=>'required|mimes:jpeg,jpg,png',
            ]);
        }
        if($this->category_id)
        {
            $this->validateOnly($fields,[
                'name'=>'required',
                'scategory_id'=>'required',
                'slug'=>'required|unique:subsub_categories,slug,'.$this->subcategory_id,
            ]);
        }
    }

    public function updatesubCategory()
    {
        $this->validate([
            'name'=>'required',
            'category_id'=>'required',
            'scategory_id'=>'required',
            'slug' => 'required|unique:subsub_categories,slug,'.$this->subcategory_id
        ]);
        if($this->newimage)
        {
            $this->validate([
                'newimage'=>'required|mimes:jpeg,jpg,png',
            ]);
        }
      
            $scategory =  SubSubCategory::find($this->subcategory_id);
            $scategory->name =$this->name;
            $scategory->slug = $this->slug;
            $scategory->category_id = $this->category_id;
            $scategory->sub_category_id = $this->scategory_id;
            
            $scategory->is_home = $this->is_home;
            if($this->newicon){
                //unlink('admin/category/icon'.'/'.$scategory->icon);
                $imageNamei= Carbon::now()->timestamp.'.'.$this->newicon->extension();
                $this->newicon->storeAs('category/icon',$imageNamei);
                $scategory->icon = $imageNamei;
            }
            if($this->newimage){
             //   unlink('admin/category'.'/'.$scategory_id->categorythum);
                $imageName= Carbon::now()->timestamp.'.'.$this->newimage->extension();
                $this->newimage->storeAs('category',$imageName);
                $scategory->categorythum = $imageName;
            }
            $scategory->save();
            
        
        session()->flash('message','Category has been upadted successfully !');
    }

    public function changeSubcategory()
    {
        $this->scategory_id = 0;
    }
    public function render()
    {
        $categories = Category::where('status','!=',3)->get();
        $subcategories = SubCategory::where('category_id', $this->category_id)->where('status','!=',3)->get();
        return view('livewire.admin.category.edit-sub-sub-category-component',['categories'=>$categories,'subcategories'=>$subcategories])->layout('layouts.admin');

    }
}
