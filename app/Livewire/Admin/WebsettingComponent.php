<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Websetting;
use Livewire\WithFileUploads;
use Carbon\Carbon; 

class WebsettingComponent extends Component
{
    use WithFileUPloads;
    public $site_name;
    public $email;
    public $web_logo;
    public $favicon;
    public $mobile_logo;
    public $phone;
    public $phone2;
    public $address;
    public $map;
    public $twiter;
    public $facebook;
    public $pinterest;
    public $instagram;
    public $youtube;

    public $newweb_logo;
    public $newfavicon;
    public $newmobile_logo;

    public function mount()
    {
        $setting = Websetting::find(1);
        if($setting)
        {
            $this->site_name = $setting->site_name;
            $this->email = $setting->email;
            $this->web_logo = $setting->web_logo;
            $this->favicon = $setting->favicon;
            $this->mobile_logo = $setting->mobile_logo;
            $this->phone = $setting->phone;
            $this->phone2 = $setting->phone2;
            $this->address = $setting->address;
            $this->map = $setting->map;
            $this->twiter = $setting->twiter;
            $this->facebook = $setting->facebook;
            $this->pinterest = $setting->pinterest;
            $this->instagram = $setting->instagram;
            $this->youtube = $setting->youtube;
        }
    }
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'email' => 'required|email',
             'phone' => 'required',
             'address' => 'required',
             'map' => 'required',
             'twiter' => 'required',
             'facebook' => 'required',
             'pinterest' => 'required',
             'instagram' => 'required',
             'youtube' => 'required',
             'site_name'=> 'required'
            ]);
             
            if($this->newweb_logo)
        {
            $this->validateOnly($fields,[
                'newweb_logo'=>'required|mimes:jpeg,jpg,png',
            ]);
        }
        if($this->newfavicon)
        {
            $this->validateOnly($fields,[
                'newfavicon'=>'required|mimes:jpeg,jpg,png',
            ]);
        }
        if($this->newmobile_logo)
        {
            $this->validateOnly($fields,[
                'newmobile_logo'=>'required|mimes:jpeg,jpg,png',
            ]);
        }
        
    }

    public function saveSettings()
    {
        $this->validate([
             'email' => 'required|email',
             'phone' => 'required',
             'address' => 'required',
             'map' => 'required',
             'twiter' => 'required',
             'facebook' => 'required',
             'pinterest' => 'required',
             'instagram' => 'required',
             'youtube' => 'required',
             'site_name'=> 'required',
             
        ]);
        if($this->newweb_logo)
        {
            $this->validate([
                'newweb_logo'=>'required|mimes:jpeg,jpg,png',
            ]);
        }
        if($this->newfavicon)
        {
            $this->validate([
                'newfavicon'=>'required|mimes:jpeg,jpg,png',
            ]);
        }
        if($this->newmobile_logo)
        {
            $this->validate([
                'newmobile_logo'=>'required|mimes:jpeg,jpg,png',
            ]);
        }

        $setting = Websetting::find(1);
        if(!$setting)
        {
            $setting = new Websetting();
        }
        $setting->site_name = $this->site_name;
        $setting->email = $this->email;
        $setting->phone = $this->phone;
        $setting->phone2 = $this->phone2;
        $setting->address = $this->address;
        $setting->map = $this->map;
        $setting->twiter = $this->twiter;
        $setting->facebook = $this->facebook;
        $setting->pinterest = $this->pinterest;
        $setting->instagram = $this->instagram;
        $setting->youtube = $this->youtube;

        if($this->newmobile_logo){
            $imageName= Carbon::now()->timestamp.'.'.$this->newmobile_logo->extension();
            $this->newmobile_logo->storeAs('logos',$imageName);
            $setting->mobile_logo = $imageName;
        }
        if($this->newfavicon){
            $imageName= Carbon::now()->timestamp.'.'.$this->newfavicon->extension();
            $this->newfavicon->storeAs('logos',$imageName);
            $setting->favicon = $imageName;
        }
        if($this->newweb_logo){
            $imageName= Carbon::now()->timestamp.'.'.$this->newweb_logo->extension();
            $this->newweb_logo->storeAs('logos',$imageName);
            $setting->web_logo = $imageName;
        }
        
        $setting->save();
        session()->flash('message','Settings has been upadted successfully!');

    }
    public function render()
    {
        return view('livewire.admin.websetting-component')->layout('layouts.admin');
    }
}
