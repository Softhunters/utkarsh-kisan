<?php

namespace App\Livewire\Admin\Package;

use App\Models\Package;
use Livewire\WithPagination;
use Livewire\Component;

class Packagecomponent extends Component
{
    use withPagination;
    public function deletePackage($id)
    {
        $category = Package::find($id);
        $category->delete();
        session()->flash('message','Package has been deleted successfully!');
    }
    public function DeactivePackage($id)
    {
        $category = Package::find($id);
        $category->status=3;
        $category->save();
        session()->flash('message','Package has been deleted successfully!');
        $this->js('window.location.reload()');

    }
    public function changeActive($id){
        $category = Package::find($id);
        $category->status=2;
        $category->save();
        session()->flash('message','Package has been deactivited successfully!');
        $this->js('window.location.reload()');
    }
    public function changeDeactive($id){
        $category = Package::find($id);
        $category->status=1;
        $category->save();
        session()->flash('message','Package has been activited successfully!');
        $this->js('window.location.reload()');
    }

    public function render()
    {
        $packages=Package::all();
         return view('livewire.admin.package.packagecomponent',['packages'=>$packages])->layout('layouts.admin');


       // return view('livewire.admin1.package.list-package-admin1',['packages'=>$packages])->layout('layouts.admin1');
    }
}
