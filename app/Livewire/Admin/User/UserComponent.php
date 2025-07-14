<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;

class UserComponent extends Component
{
    public function DeactiveUser($id)
    {
        $category = User::find($id);
        $category->is_active=0;
        $category->save();
        session()->flash('message','User has been Deactive successfully!');
        $this->js('window.location.reload()');
    }
    public function ActiveUser($id)
    {
        $category = User::find($id);
        $category->is_active=1;
        $category->save();
        session()->flash('message','User has been Active successfully!');
        $this->js('window.location.reload()');
    }
    public function deleteUser($id)
    {
        $category = User::find($id);
        $category->is_active=3;
        $category->save();
        session()->flash('message','User has been deleted successfully!');
        $this->js('window.location.reload()');
    }
    public function render()
    {
        $user=User::where('is_active','!=',3)->where('utype', 'USR')->get();
        return view('livewire.admin.user.user-component',['users'=>$user])->layout('layouts.admin');
    }
}
