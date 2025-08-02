<?php

namespace App\Livewire\Admin\Package;

use Livewire\Component;
use App\Models\Package;

class EditPackagecomponent extends Component
{
    public $up_to;
    public $pname;
    public $ptype;
    public $price;
    public $description;
    public $validity;
    public $count;
    public $pid;
    public $p_id;

    public function mount($pid)
    {
        //dd($scategory_slug);
        
        
            $this->p_id= $pid;
            $package =Package::where('id',$this->p_id)->first();
            $this->up_to = $package->up_to;
            $this->pname= $package->pname;
            $this->ptype = $package->ptype;
            $this->price = $package->price;
            $this->validity = $package->validity;
            $this->count=$package->count;
            $this->description = $package->description;
            $this->p_id = $package->id;
    
    }
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'ptype'=>'required',
            'price'=>'required',
            'validity'=>'required',
            'count'=>'required',
            'description'=>'required',
            'pname'=>'required|unique:packages,pname,'.$this->p_id,
            'up_to' =>'required'
        ]);
    }

    public function updatePacakge()
    {
        $this->validate([
            'pname'=>'required',
            'price'=>'required',
            'validity'=>'required',
            'count'=>'nullable',
            'description'=>'required',
            'ptype'=>'required|unique:packages,ptype,'.$this->p_id,
            'up_to' =>'nullable'
        ],[
            'pname.required'=>'The package name field is required.',
            'ptype.required'=>'The package type field is required.',
        //     'count.required'=>'The visiting count field is required.',
        //    'up_to.required'=>'The package valid upto field is required.'
            ]);
        
            
     
            $package = Package::find($this->p_id);
            $package->pname = $this->pname;
            $package->ptype = $this->ptype;
            $package->price = $this->price;
            $package->validity = $this->validity;
            $package->count=$this->count;
            $package->up_to_date = $this->up_to;
            $package->description = $this->description;         
            $package->save();
        
        session()->flash('message','Package has been upadted successfully !');
    }
    
    public function render()
    {
         return view('livewire.admin.package.edit-packagecomponent')->layout('layouts.admin');


        //return view('livewire.admin1.package.edit-package-admin1')->layout('layouts.admin1');
    }
}
