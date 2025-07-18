<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Testimonial;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class AddTestimonialComponent extends Component
{
    use WithFileUPloads;
    public $name;
    public $email;
    public $phone;
    public $position;
    public $star;
    public $image;
    public $short_description;

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'position'=>'required',
            'star'=>'required',
            'short_description'=>'required',
        ]);
        if($this->image)
        {
            $this->validateOnly($fields,[
                'image'=>'required|mimes:jpeg,jpg,png',
            ]);
        }
    }
    public function storeTestimonial()
    {
        $this->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'position'=>'required',
            'star'=>'required',
            'short_description'=>'required',
        ]);
        if($this->image)
        {
            $this->validate([
                'image'=>'required|mimes:jpeg,jpg,png',
            ]);
        }
        
        $test = new Testimonial();
            $test->name = $this->name;
            $test->email = $this->email;
            $test->phone = $this->phone;
            $test->position = $this->position;
            $test->star = $this->star;
            $test->description = $this->short_description;
            if($this->image){
                $imageName= Carbon::now()->timestamp.'.'.$this->image->extension();
                $this->image->storeAs('testimonial',$imageName);
                $test->image = $imageName;
                }
            $test->save();
        
        session()->flash('message','Testimonial has been Added successfully!');

    }
    public function render()
    {
        return view('livewire.admin.testimonial.add-testimonial-component')->layout('layouts.admin');
    }
}
