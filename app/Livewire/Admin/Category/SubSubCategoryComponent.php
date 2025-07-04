<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class SubSubCategoryComponent extends Component
{
    use withPagination;
    public function deleteCategory($id)
    {
        $category = SubSubCategory::find($id);
        $category->delete();
        session()->flash('message','Category has been deleted successfully!');
    }
     public function DeactiveSubCategory($id)
    {
        $category = SubSubCategory::find($id);
        $category->status=0;
        $category->save();
        session()->flash('message','SubCategory has been Deactive successfully!');
        $this->js('window.location.reload()');
    }
    public function ActiveSubCategory($id)
    {
        $category = SubSubCategory::find($id);
        $category->status=1;
        $category->save();
        session()->flash('message','SubCategory has been Active successfully!');
        $this->js('window.location.reload()');
    }
    public function deleteSubCategory($id)
    {
        $category = SubSubCategory::find($id);
        $category->status=3;
        $category->save();
        session()->flash('message','Sub-Category has been deleted successfully!');
        $this->js('window.location.reload()');
    }
    public function render()
    {
        $categories=SubSubCategory::where('status','!=',3)->get();
        return view('livewire.admin.category.sub-sub-category-component',['categories'=>$categories])->layout('layouts.admin');
    }
}
