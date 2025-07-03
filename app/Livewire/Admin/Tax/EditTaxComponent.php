<?php

namespace App\Livewire\Admin\Tax;

use Livewire\Component;
use App\Models\Tax;

class EditTaxComponent extends Component
{
    public $tax_name;
    public $type;
    public $status;
    public $value;
    public $t_id;

    public function mount($bid)
    {
        $tax = Tax::find($bid);
        $this->tax_name = $tax->tax_name;
        $this->type = $tax->type;
        $this->value = $tax->value;
        $this->status = $tax->status;
        $this->t_id = $tax->id;
    }
    public function updated($fields)
    {
        $this->validateonly($fields,[
            'tax_name'=>'required',
            'type'=>'required',
            'value' =>'required',
            'status'=>'required'
        ]);
    }
    public function updateTax()
    {
        $this->validate([
            'tax_name'=>'required',
            'type'=>'required',
            'value' =>'required',
            'status'=>'required'
        ]);
        $tax = TAx::find($this->t_id);
        $tax->tax_name = $this->tax_name;
        $tax->type = $this->type;
        $tax->status = $this->status;
        $tax->value = $this->value;
        $tax->save(); 
        Session()->flash('message','Tax has been Updated Successfully!');
        
    }
    public function render()
    {
        return view('livewire.admin.tax.edit-tax-component')->layout('layouts.admin');
    }
}
