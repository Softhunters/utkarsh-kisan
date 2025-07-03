<?php

namespace App\Livewire\Admin\Tax;

use Livewire\Component;
use App\Models\Tax;

class TaxComponent extends Component
{
    public function DeactiveTax($id)
    {
        $category = Tax::find($id);
        $category->status=0;
        $category->save();
        session()->flash('message','Tax has been Deactive successfully!');
        $this->js('window.location.reload()');
    }
    public function ActiveTax($id)
    {
        $category = Tax::find($id);
        $category->status=1;
        $category->save();
        session()->flash('message','Tax has been Active successfully!');
        $this->js('window.location.reload()');
    }
    public function deleteTax($id)
    {
        $category = Tax::find($id);
        $category->status=3;
        $category->save();
        session()->flash('message','Tax has been deleted successfully!');
        $this->js('window.location.reload()');
    }
    public function render()
    {
        $taxs = Tax::where('status','!=',3)->get();
        return view('livewire.admin.tax.tax-component',['taxs'=>$taxs])->layout('layouts.admin');
    }
}
