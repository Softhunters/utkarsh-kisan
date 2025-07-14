<?php

namespace App\Livewire\Admin\Category;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use App\Models\SubCategory;

class CategoryComponent extends Component
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
        $this->js('window.location.reload()');
    }
    public function deleteSubCategory($id)
    {
        $category = SubCategory::find($id);
        $category->status = 3;
        $category->save();

        Product::where('subcategory_id', $id)->update(['status' => 3]);

        session()->flash('message', 'Sub Category has been deleted successfully!');
        $this->js('window.location.reload()');
    }
    public function DeactiveCategory($id)
    {
        $category = Category::find($id);
        $category->status = 0;
        $category->save();

        SubCategory::where('category_id', $id)->update(['status' => 0]);

        Product::whereIn('category_id', $id)->update(['status' => 0]);

        session()->flash('message', 'Category has been Deactive successfully!');
        $this->js('window.location.reload()');
    }
    public function ActiveCategory($id)
    {
        $category = Category::find($id);
        $category->status = 1;
        $category->save();

        SubCategory::where('category_id', $id)->update(['status' => 1]);

        Product::whereIn('category_id', $id)->update(['status' => 1]);

        session()->flash('message', 'Category has been Active successfully!');
        $this->js('window.location.reload()');
    }
    public function render()
    {
        $categories = Category::where('status', '!=', 3)->get();

        return view('livewire.admin.category.category-component', ['categories' => $categories])->layout('layouts.admin');
    }
}
