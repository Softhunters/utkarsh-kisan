<?php

namespace App\Livewire\Admin\Category;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use App\Models\SubCategory;

class SubCategoryComponent extends Component
{
    use withPagination;
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->status = 3;
        $category->save();

        SubCategory::where('category_id', $id)->update(['status' => 3]);

        Product::whereIn('category_id', $id)->update(['status' => 3]);

        session()->flash('message', 'Category has been deleted successfully!');
    }
    public function DeactiveSubCategory($id)
    {
        $category = SubCategory::find($id);
        $category->status = 0;
        $category->save();

        Product::whereIn('subcategory_id', $id)->update(['status' => 0]);

        session()->flash('message', 'SubCategory has been Deactive successfully!');
        $this->js('window.location.reload()');
    }
    public function ActiveSubCategory($id)
    {
        $category = SubCategory::find($id);
        $category->status = 1;
        $category->save();

        Product::whereIn('subcategory_id', $id)->update(['status' => 1]);

        session()->flash('message', 'SubCategory has been Active successfully!');
        $this->js('window.location.reload()');
    }
    public function deleteSubCategory($id)
    {
        $category = SubCategory::find($id);
        $category->status = 3;
        $category->save();

        Product::whereIn('subcategory_id', $id)->update(['status' => 3]);

        session()->flash('message', 'Sub-Category has been deleted successfully!');
        $this->js('window.location.reload()');
    }
    public function render()
    {
        $categories = SubCategory::where('status', '!=', 3)->get();
        //dd($categories);
        return view('livewire.admin.category.sub-category-component', ['categories' => $categories])->layout('layouts.admin');
    }
}
