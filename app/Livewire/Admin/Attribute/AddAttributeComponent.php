<?php

namespace App\Livewire\Admin\Attribute;

use Livewire\Component;
use App\Models\Attribute;

class AddAttributeComponent extends Component
{
    public $name;
    public $status;
  
    
    public function mount()
    {
        $this->status = 1;                         
                                                        
    }
    public function updated($fields)
    {
        $this->validateonly($fields,[
             'name'=>'required|unique:attributes',
             'status'=>'required',
             
        ]);
    }
    public function storeAttribute()
    {
        $this->validate([
            'name'=>'required|unique:attributes',
            'status'=>'required',
        ]);

        $brand =new Attribute();
        $brand->name= $this->name;
        $brand->status= $this->status;
        $brand->save();
        Session()->flash('message','Attribute has been Created Successfully!');
    }
    public function render()
    {
        return view('livewire.admin.attribute.add-attribute-component')->layout('layouts.admin');;
    }
}
