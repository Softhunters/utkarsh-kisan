<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use App\Models\SubCategory;


class AddSubCategoryComponent extends Component
{
    use WithFileUPloads;
    public $name;
    public $slug;
    public $category_id;
    public $icon;
    public $categorythum;
    public $is_home;
    

    public function generateslug()
    {
        $this->slug = Str::slug($this->name);
    }
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name'=>'required',
            'slug'=>'required|unique:sub_categories',
            'category_id'=>'required',
            'is_home'=>'required'
        ]);
    }
    public function storeCategory()
    {
        $this->validate([
            'name'=>'required',
            'slug' => 'required|unique:sub_categories',
            'category_id'=>'required',
            'is_home'=>'required'
        ],[
            'category_id.required'=>'The category field is required.',
            ]);
        
        if($this->category_id){
            $scategory_id = new SubCategory();
            $scategory_id->name =$this->name;
            $scategory_id->slug = $this->slug;
            $scategory_id->category_id = $this->category_id;
            $scategory_id->is_home = $this->is_home;
            if($this->icon){
                $imageNamei= Carbon::now()->timestamp.'.'.$this->icon->extension();
                $this->icon->storeAs('category/icon',$imageNamei);
                $scategory_id->icon = $imageNamei;
            }
            // if($this->categorythum){
            //     $imageName= Carbon::now()->timestamp.'.'.$this->categorythum->extension();
            //     $this->categorythum->storeAs('category',$imageName);
            //     $scategory_id->categorythum = $imageName;
            //     }
            $scategory_id->save();
        }else{

            $category = new Category();
            $category->name = $this->name;
            $category->slug = $this->slug;
            $category->is_home = $this->is_home;
            if($this->icon){
                $imageNamei= Carbon::now()->timestamp.'.'.$this->icon->extension();
                $this->icon->storeAs('category/icon',$imageNamei);
                $category->icon = $imageNamei;
            }
            if($this->categorythum){
                $imageName= Carbon::now()->timestamp.'.'.$this->categorythum->extension();
                $this->categorythum->storeAs('category',$imageName);
                $category->categorythum = $imageName;
                }
            $category->save();
        }
        session()->flash('message','Sub Category has been created successfully!');
    }
    public function render()
    {   $categories = Category::where('status','!=',3)->get();
        return view('livewire.admin.category.add-sub-category-component',['categories'=>$categories])->layout('layouts.admin');
    }
}
