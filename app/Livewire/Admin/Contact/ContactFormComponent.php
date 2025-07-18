<?php

namespace App\Livewire\Admin\Contact;

use Livewire\Component;
use App\Models\ContactForm;

class ContactFormComponent extends Component
{
    public function render()
    {
        $contacts=ContactForm::all(); 
        return view('livewire.admin.contact.contact-form-component',['contacts'=>$contacts])->layout('layouts.admin');
    }
}
