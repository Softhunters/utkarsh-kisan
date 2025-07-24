<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use App\Models\Testimonial;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class EditTestimonialComponent extends Component
{
    use WithFileUPloads;
    public $name;
    public $email;
    public $phone;
    public $position;
    public $star;
    public $image;
    public $short_description;
    public $newimage;
    public $tid;
    public $t_id;

    public function mount($tid)
    {
        //dd($scategory_slug);

        $this->t_id = $tid;
        $package = Testimonial::where('id', $this->t_id)->first();
        $this->star = $package->star;
        $this->name = $package->name;
        $this->email = $package->email;
        $this->phone = $package->phone;
        $this->position = $package->position;
        $this->short_description = $package->description;
        $this->image = $package->image;
        $this->t_id = $package->id;

    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'position' => 'required',
            'star' => 'required',
            'short_description' => 'required',
        ]);
        if ($this->newimage) {
            $this->validateOnly($fields, [
                'image' => 'required|mimes:jpeg,jpg,png',
            ]);
        }
    }
    public function updateTestimonial()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'position' => 'required',
            'star' => 'required',
            'short_description' => 'required',
        ]);
        if ($this->newimage) {
            $this->validate([
                'newimage' => 'required|mimes:jpeg,jpg,png',
            ]);
        }

        $test = Testimonial::find($this->t_id);
        $test->name = $this->name;
        $test->email = $this->email;
        $test->phone = $this->phone;
        $test->position = $this->position;
        $test->star = $this->star;
        $test->description = $this->short_description;
        if ($this->newimage) {
            if ($test->image) {

                $imagePath = public_path('admin/testimonial/' . $test->image);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('testimonial', $imageName);
            $test->image = $imageName;
        }
        $test->save();

        session()->flash('message', 'Testimonial has been updated successfully!');

    }
    public function render()
    {
        return view('livewire.admin.testimonial.edit-testimonial-component')->layout('layouts.admin');
    }
}
