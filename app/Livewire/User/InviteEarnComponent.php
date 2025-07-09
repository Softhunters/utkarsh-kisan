<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class InviteEarnComponent extends Component
{
    public $rcode;
    public function render()
    {
        $shareButtons = \Share::page(route('udregisteorview',['rcode'=>Auth::user()->referral_code]))->facebook()->twitter()->linkedin()->telegram()->whatsapp()->reddit();
        return view('livewire.users.invite-earn-component',['shareButtons'=>$shareButtons])->layout('layouts.main');
    }

    public function ApplyRcode()
    {
        $this->validate([
            'rcode' => ['required', 'string', 'min:6']
        ]);
        
        $check = User::where('referral_code',$this->rcode)->where('id','!=',Auth::user()->id)->first();
        if(isset($check))
        {
            User::where('id',Auth::user()->id)->update(['referral_by' => $this->rcode]);
            session()->flash('success', 'Referral Code has been applied successfully');
        }else{
            session()->flash('error','Referral Code not Found!');
        }
    }
}
