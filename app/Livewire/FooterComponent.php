<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Websetting;
class FooterComponent extends Component
{
    public function render()
    {
        $setting = Websetting::find(1); 
        return view('livewire.footer-component',['setting'=>$setting]);
    }
}
