<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class AccountComponent extends Component
{
    use WithFileUPloads;
    public $name;
    public $email;
    public $phone;
    public $profile;
    public $newprofile;
    public $u_id;

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->profile = Auth::user()->profile;
        $this->phone = Auth::user()->phone;
        $this->email = Auth::user()->email;
        $this->u_id = Auth::user()->id;
// dd($this->profile);
    }
    public function render()
    {
        return view('livewire.users.account-component')->layout('layouts.main');
    }

   
    public function close()
    {
        $this->resetInputs();
    }
    public function resetInputs()
    {
        $this->password = '';
        $this->old_password = '';
        $this->password_confirmation = '';
       
    }
    public function UpdateINfo()
    {
        $this->validate([
            'name'=>'required',
            'phone' => 'required|numeric|digits:10|unique:users,phone,'.$this->u_id.'',
            'email' => 'required|email|unique:users,email,'.$this->u_id.'',
        ]);
        if($this->newprofile)
        {
            $this->validate([
                'newprofile'=>'required|mimes:jpeg,jpg,png',
            ]);
        }

        $user = User::find($this->u_id);
        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->email = $this->email;
        if($this->newprofile){
            if($user->profile)
            {
                unlink('admin/profilespic'.'/'.$user->profile);
            }

            $imageName= Carbon::now()->timestamp.'.'.$this->newprofile->extension();
            $this->newprofile->storeAs('profilespic',$imageName);
            $user->profile = $imageName;
        }
        
        $user->save();
        session()->flash('info','Info has been upadted successfully!');

    }

}