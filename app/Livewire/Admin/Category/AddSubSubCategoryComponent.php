<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class AddSubSubCategoryComponent extends Component
{
    use WithFileUPloads;
    public $name;
    public $slug;
    public $category_id;
    public $scategory_id;
    public $icon;
    public $categorythum;
    public $is_home;
    //  public function mount()
    // {
    //     $this->is_home = 0;
    // }

    public function generateslug()
    {
        $this->slug = Str::slug($this->name);
    }
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name'=>'required',
            'slug'=>'required|unique:subsub_categories',
            'category_id'=>'required',
            'scategory_id'=>'required'
        ]);
    }
    public function storeSubCategory()
    {
        $this->validate([
            'name'=>'required',
            'slug' => 'required|unique:subsub_categories',
            'category_id'=>'required',
            'scategory_id'=>'required'
        ],[
            'category_id.required'=>'The category field is required.',
            'scategory_id.required'=>'The sub-category field is required.',
            ]);
        
       
            $scategory_id = new SubSubCategory();
            $scategory_id->name =$this->name;
            $scategory_id->slug = $this->slug;
            $scategory_id->category_id = $this->category_id;
            $scategory_id->sub_category_id = $this->scategory_id;
            
            if($this->icon){
                $imageNamei= Carbon::now()->timestamp.'.'.$this->icon->extension();
                $this->icon->storeAs('category/icon',$imageNamei);
                $scategory_id->icon = $imageNamei;
            }
            if($this->categorythum){
                $imageName= Carbon::now()->timestamp.'.'.$this->categorythum->extension();
                $this->categorythum->storeAs('category',$imageName);
                $scategory_id->categorythum = $imageName;
                }
            $scategory_id->save();
        
        session()->flash('message','Sub Category has been created successfully!');
    }

    public function changeSubcategory()
    {
        $this->scategory_id = 0;
    }

    public function render()
    {
        $categories = Category::where('status','!=',3)->get();
        $subcategories = SubCategory::where('category_id', $this->category_id)->where('status','!=',3)->get();
        return view('livewire.admin.category.add-sub-sub-category-component',['categories'=>$categories,'subcategories'=>$subcategories])->layout('layouts.admin');

    }
}
