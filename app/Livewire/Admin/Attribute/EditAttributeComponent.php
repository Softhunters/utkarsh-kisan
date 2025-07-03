<?php

namespace App\Livewire\Admin\Attribute;

use Livewire\Component;
use App\Models\Attribute;

class EditAttributeComponent extends Component
{
    public $name;
    public $status;
    public $attribute_id;
    public function mount($att_id)
    {
        $brand = Attribute::find($att_id);
        $this->attribute_id = $brand->id;
        $this->name= $brand->name;
        $this->status= $brand->status;
    }
    public function updated($fields)
    {
        $this->validateonly($fields,[
             
             'status'=>'required',
             'name' => 'required|unique:attributes,name,'.$this->attribute_id
        ]);
    }
    public function updateAttribute()
    {
        $this->validate([
            'status'=>'required',
            'name' => 'required|unique:attributes,name,'.$this->attribute_id

        ]);

        $brand = Attribute::find($this->attribute_id);
        $brand->name= $this->name;
        $brand->status= $this->status;
        $brand->save();
        Session()->flash('message','Attribute has been updated Successfully!');
    }

    public function render()
    {
        return view('livewire.admin.attribute.edit-attribute-component')->layout('layouts.admin');;
    }
}
