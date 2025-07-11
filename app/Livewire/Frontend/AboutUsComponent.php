<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Testimonial;

class AboutUsComponent extends Component
{
    public function render()
    {
        $testimonials = Testimonial::all();
        return view('livewire.frontend.about-us-component',['testimonials'=>$testimonials])->layout('layouts.main');
    }
}
