<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use App\Models\Testimonial;
use Livewire\WithPagination;

class TestimonialComponent extends Component
{
    use withPagination;
    public function ActiveStatus($id)
    {
        $category = Testimonial::find($id);
        $category->status = 1;
        $category->save();
        session()->flash('message','Testimonial has been Active successfully!');
        $this->js('window.location.reload()');
    }
    public function DeactiveStatus($id)
    {
        $category = Testimonial::find($id);
        $category->status = 0;
        $category->save();
        session()->flash('message','Testimonial has been Deactive successfully!');
        $this->js('window.location.reload()');
    }
    public function Verifiedstatus($id)
    {
        $category = Testimonial::find($id);
        $category->verified = 1;
        $category->save();
        session()->flash('message','Testimonial has been verified successfully!');
        $this->js('window.location.reload()');
    }
    public function DeVerifiedstatus($id)
    {
        $category = Testimonial::find($id);
        $category->verified = 0;
        $category->save();
        session()->flash('message','Testimonial has been Deverified successfully!');
        $this->js('window.location.reload()');
    }
    public function render()
    {
        $testimonials = Testimonial::all();
        return view('livewire.admin.testimonial.testimonial-component',['testimonials'=>$testimonials])->layout('layouts.admin');
    }
}
