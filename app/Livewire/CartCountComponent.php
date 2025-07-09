<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Session;
use App\Models\Cart;
use Livewire\Attributes\On;

use Illuminate\Support\Facades\Auth;

class CartCountComponent extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];
    public $cartcount;
    public $cartlist = [];


    #[On('cart_add')]
    public function render(Request $request)
    {

        $this->cartcount = 0;
        if (Auth::check()) {
            $this->cartlist = Cart::where('user_id', Auth::user()->id)->get();
            $this->cartcount = Cart::where('user_id', Auth::user()->id)->get()->count();

        } else {
            if (Session::has('cart')) {
                $this->cartlist = $request->session()->get('cart');
                $this->cartcount = count($this->cartlist);
            }
        }
        return view('livewire.cart-count-component');
    }
}