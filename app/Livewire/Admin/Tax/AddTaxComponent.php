<?php

namespace App\Livewire\Admin\Tax;

use Livewire\Component;
use App\Models\Tax;

class AddTaxComponent extends Component
{
    public $tax_name;
    public $type;
    public $status;
    public $value;

    // public function mount()
    // {
    //     $this->type = 1;
    //     $this->status = 1;
    // }
     public function updated($fields)
    {
        $this->validateOnly($fields,[
            'tax_name'=>'required',
            'type'=>'required',
            'value' =>'required',
            'status'=>'required'
        ]);
    }
    public function addTax()
    {
        $this->validate([
            'tax_name'=>'required',
            'type'=>'required',
            'value' =>'required',
            'status'=>'required'
        ]);
        $tax = new Tax();
        $tax->tax_name = $this->tax_name;
        $tax->type = $this->type;
        $tax->status = $this->status;
        $tax->value = $this->value;
        $tax->save(); 
        Session()->flash('message','Tax has been Created Successfully!');

    }
    public function render()
    {
        return view('livewire.admin.tax.add-tax-component')->layout('layouts.admin');
    }
}
