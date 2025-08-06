<?php

namespace App\Livewire\Admin\Package;

use Livewire\Component;
use App\Models\Package;


class AddPackagecomponent extends Component
{
    public $up_to;
    public $pname;
    public $ptype;
    public $price;
    // public $count;
    public $validity;
    public $description;
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'pname'=>'required|unique:packages',
            'ptype'=>'required|unique:packages',
            'price'=>'required',
            'validity'=>'required',
            // 'count'=>'required',
            'description' =>'required',
            'up_to' =>'required'
        ]);
    }

    public function storePackage()
    {
        $this->validate([
            'pname'=>'required|unique:packages',
            'ptype'=>'required|unique:packages',
            'price'=>'required',
            'validity'=>'required',
            // 'count'=>'nullable',
            'description' =>'required',
            'up_to' =>'nullable'
        ],[
            'pname.required'=>'The package name field is required.',
            'ptype.required'=>'The package type field is required.',
        //     'count.required'=>'The visiting count field is required.',
        //    'up_to.required'=>'The package valid upto field is required.'
            ]);
        
            $slug = createSlug($this->pname, Package::class, 'pslug');
       

            $package = new Package();
            $package->pname = $this->pname;
            $package->ptype = $this->ptype;
            $package->pslug = $slug;
            $package->price = $this->price;
            $package->validity = $this->validity;
            // $package->count = $this->count;
            $package->description = $this->description;
            $package->up_to_date = $this->up_to;
            $package->status = '1';
            $package->save();
    
        session()->flash('message','Package has been created successfully!');
    }

    public function render()
    {
         return view('livewire.admin.package.add-packagecomponent')->layout('layouts.admin');

       // return view('livewire.admin1.package.add-package-admin1')->layout('layouts.admin1');
    }
}
