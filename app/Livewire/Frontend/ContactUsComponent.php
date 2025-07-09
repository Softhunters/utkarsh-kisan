<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Websetting;
use App\Models\ContactForm;

class ContactUsComponent extends Component
{
    public $name;
    public $subject;
    public $phone;
    Public $email;
    public $message;
    // public $checkbox;
    // public $thankyou;

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'subject'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'message'=>'required',
        ]);
    }

    public function addContactform()
    {

        $this->validate([
            'subject'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'message'=>'required',
        ]);

        $contact = new ContactForm();
        $contact->name = $this->name;
        $contact->subject = $this->subject;
        $contact->phone = $this->phone;
        $contact->email = $this->email;
        $contact->message = $this->message;
        $contact->save();
        Session()->flash('message','Message has been Send Successfully!');
    }
    public function render()
    {
        $setting = Websetting::find(1); 
        return view('livewire.frontend.contact-us-component',['setting'=>$setting])->layout('layouts.main');
    }
}
