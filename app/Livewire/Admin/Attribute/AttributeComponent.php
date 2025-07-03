<?php

namespace App\Livewire\Admin\Attribute;

use Livewire\Component;
use App\Models\Attribute;

class AttributeComponent extends Component
{
     public function DeactiveAttribute($id)
    {
        $category = Attribute::find($id);
        $category->status=0;
        $category->save();
        session()->flash('message','Attribute has been Deactive successfully!');
        $this->js('window.location.reload()');
    }
    public function ActiveAttribute($id)
    {
        $category = Attribute::find($id);
        $category->status=1;
        $category->save();
        session()->flash('message','Attribute has been Active successfully!');
        $this->js('window.location.reload()');
    }
    public function deleteAttribute($id)
    {
        $category = Attribute::find($id);
        $category->status=3;
        $category->save();
        session()->flash('message','Attribute has been deleted successfully!');
        $this->js('window.location.reload()');
    }
    public function render()
    {
        $attributes = Attribute::where('status','!=',3)->get(); 
        return view('livewire.admin.attribute.attribute-component',['attributes'=>$attributes])->layout('layouts.admin');;
    }

}
