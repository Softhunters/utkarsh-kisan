<?php

namespace App\Livewire\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class AddressComponent extends Component
{
    public $name;
    public $email;
    public $mobile;
    public $mobile_optional;
    public $line1;
    public $line2;
    public $landmark;
    public $city_id;
    public $state_id;
    public $country_id;
    public $zipcode;
    public $address_type;
    public $default_address;
    public $st_id;
    public $address_delete_id;
    public $ship_id;

    public function render()
    {
        $countries = Country::all();
        $states = State::where('country_id',$this->country_id)->orderBy('name','ASC')->get();
        $cities = City::where('state_id',$this->st_id)->orderBy('name','ASC')->get();
        $ships = ShippingAddress::where('user_id',Auth::user()->id)->get();
        return view('livewire.users.address-component',['countries'=>$countries,'states'=>$states,'cities'=>$cities,'ships'=>$ships])->layout('layouts.main');
    }

    public function changecountry()
    {
        //dd($this->country_id);
        $this->state_id = 0;
        $this->city_id = 0;
        return;
    }
    public function changestate()
    {
        $this->st_id = $this->state_id;
        $this->city_id = 0;
        return;
        
    }

    public function adddress()
    {
        $this->dispatch('show-add-address-modal');
        return;
    }

    public function addAddress()
    {
        //dd($this->address_type, $this->default_address);
        $this->validate([
            'name'=>'required',
            
            'mobile'=>'required|numeric|digits:10',
           // 'mobile_optional'=>'required',
            'line1'=>'required',
           // 'line2'=>'required',
            //'landmark'=>'required',
            'city_id'=>'required',
            'state_id'=>'required',
            'country_id'=>'required',
            'zipcode'=>'required|numeric|digits:6',
            'address_type'=>'required',
           
        ]);
        //dd('heloo');

        $ship = new ShippingAddress();
        $ship->name = $this->name;
        $ship->user_id = Auth::user()->id;
        $ship->mobile = $this->mobile;
        $ship->mobile_optional = $this->mobile_optional;
        $ship->line1 = $this->line1;
        $ship->line2 = $this->line2;
        $ship->landmark = $this->landmark;
        $ship->city_id = $this->city_id;
        $ship->state_id = $this->state_id;
        $ship->country_id = $this->country_id;
        $ship->zipcode = $this->zipcode;
        $ship->address_type = $this->address_type;
        if($this->default_address){
            ShippingAddress::where('user_id', Auth::user()->id)->update(['default_address' => 0]);
            $ship->default_address = '1';
        }
        $ship->save();

        session()->flash('message', 'Address has been added successfully');
        $this->resetInputs();
        //For hide modal after add post added successfully
        $this->dispatch('close-modal');
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->email = '';
        $this->mobile = '';
        $this->mobile_optional = '';
        $this->line1 = '';
        $this->line2 = '';
        $this->landmark = '';
        $this->city_id = '';
        $this->state_id = '';
        $this->country_id = '';
        $this->zipcode = '';
        $this->address_type = '';
        $this->default_address = '';
        $this->st_id = '';
        $this->ship_id= '';
    }

    public function deleteConfirmation($id)
    {
        $this->address_delete_id = $id; //post id

        $this->dispatch('show-delete-confirmation-modal');
    }


    public function deletePostData()
    {
        ShippingAddress::destroy($this->address_delete_id);

        session()->flash('message', 'Address has been deleted successfully');

        $this->dispatch('close-modal');

        $this->address_delete_id = '';
    }

    public function cancel()
    {
        $this->address_delete_id = '';
    }

    public function editPost($id)
    {
        $ship = ShippingAddress::find($id);

        $this->name = $ship->name;
        $this->mobile = $ship->mobile;
        $this->mobile_optional = $ship->mobile_optional;
        $this->line1 = $ship->line1;
        $this->line2 = $ship->line2;
        $this->landmark = $ship->landmark;
        $this->city_id = $ship->city_id;
        $this->state_id = $ship->state_id;
        $this->country_id = $ship->country_id;
        $this->zipcode = $ship->zipcode;
        $this->address_type = $ship->address_type;
        $this->default_address = $ship->default_address;
        $this->st_id = $ship->state_id;
        $this->ship_id = $ship->id;

        // dd($this->state_id,$this->city_id);
        
        //dd($this->coupon_id);
        $this->dispatch('show-edit-post-modal');
    }
    
    public function editPostData()
    {
        //dd($this->coupon_id);
        //on form submit validation
        $this->validate([
            'name'=>'required',
            
            'mobile'=>'required|numeric|digits:10',
           // 'mobile_optional'=>'required',
            'line1'=>'required',
           // 'line2'=>'required',
            //'landmark'=>'required',
            'city_id'=>'required',
            'state_id'=>'required',
            'country_id'=>'required',
            'zipcode'=>'required|numeric|digits:6',
            'address_type'=>'required',
           
        ]);

        $ship = ShippingAddress::find($this->ship_id);
        $ship->name = $this->name;
        $ship->user_id = Auth::user()->id;
        $ship->mobile = $this->mobile;
        $ship->mobile_optional = $this->mobile_optional;
        $ship->line1 = $this->line1;
        $ship->line2 = $this->line2;
        $ship->landmark = $this->landmark;
        $ship->city_id = $this->city_id;
        $ship->state_id = $this->state_id;
        $ship->country_id = $this->country_id;
        $ship->zipcode = $this->zipcode;
        $ship->address_type = $this->address_type;
        if($this->default_address){
            ShippingAddress::where('user_id', Auth::user()->id)->update(['default_address' => 0]);
            $ship->default_address = '1';
        }
        $ship->save();

        session()->flash('message', 'Address has been updated successfully');

        //For hide modal after add post added successfully
        $this->dispatch('close-modal');
    }

    public function close()
    {
        $this->resetInputs();
        $this->dispatch('close-modal');
    }

}