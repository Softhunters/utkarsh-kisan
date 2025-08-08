<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\User;
use Session;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function uloginauth(Request $request)
    {
        //dd($request);
        $valid = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'The Email field is required.',
            'password.required' => 'The Password field is required.',
        ]);
        if (!$valid->passes()) {
            return response()->json(['status' => 'error', 'msg' => 'Email and password field are required']);
        }

        if ($this->attemptLogin($request)) {

            if (Auth::user()->status == 0 || Auth::user()->is_active == 3) {
                Auth::logout();
                return redirect()->back()->withErrors([
                    'email' => 'Your account is blocked or deactivated. Please contact support.',
                ]);
            }

            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }
            if (!isset(Auth::user()->referral_code)) {
                User::where('id', Auth::user()->id)->update(['referral_code' => $this->ticket_number()]);
            }

            session(['user_id' => Auth::id()]);

            $this->movewishlist($request);
            $this->movecart($request);

            return response()->json(['status' => 'success', 'msg' => 'msg']);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Email and password are not matched']);
        }

    }
    public function vendorloginAuth(Request $request)
    {
        
        $valid = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'The Email field is required.',
            'email.email' => 'The Email format is not valid.',
            'password.required' => 'The Password field is required.',
        ]);
        if (!$valid->passes()) {
            return redirect()->back()
                ->withErrors($valid)
                ->withInput();
        }


        if ($this->attemptLogin($request)) {

            if (Auth::user()->utype != "VDR") {
                Auth::logout();
                return redirect()->back()->with([
                    'error' => 'No Kisan account found.',
                ]);
            }

            if (Auth::user()->status == 0 || Auth::user()->is_active == 3) {
                Auth::logout();
                return redirect()->back()->withErrors([
                    'error' => 'Your account is blocked or deactivated. Please contact support.',
                ]);
            }


            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }
            if (!isset(Auth::user()->referral_code)) {
                User::where('id', Auth::user()->id)->update(['referral_code' => $this->ticket_number()]);
            }

            session(['user_id' => Auth::id()]);

            $this->movewishlist($request);
            $this->movecart($request);

            $vendor = User::find(Auth::id());

            if ($vendor->vendorPackage) {
                return redirect()->route('vendor.dashboard');
            } else {
                return redirect()->route('vendor.package');
            }

        } else {
            return redirect()->back()->with('error', 'Email or Password not match!');
        }

    }

    public function uloginview(Request $request)
    {
        return view('livewire.login');
    }
    public function adminlogin(Request $request)
    {
        //dd($request);
        return view('auth.adminlogin');
    }
    public function vendorlogin(Request $request)
    {
        if(Auth::check()){
            if(Auth::user()->utype == 'VDR'){
                return redirect()->route('vendor.dashboard');
            }
        }
        
        return view('livewire.login');
    }

    public function adminloginauth(Request $request)
    {
        // dd($request);
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }
            //dd(Auth::user());
            //return $this->sendLoginResponse($request);
            session(['user_id' => Auth::id()]);
            $user = Auth::user();

            if (Auth::user()->utype != "ADM") {
                Auth::logout();
                return redirect()->back()->with([
                    'error' => 'No Admin account found.',
                ]);
            }

            if ($user->status == 0 || $user->is_active == 3) {
                Auth::logout();
                return redirect()->back()->withErrors([
                    'email' => 'Your account is blocked or deactivated. Please contact support.',
                ]);
            }

            if (!isset(Auth::user()->referral_code)) {
                User::where('id', Auth::user()->id)->update(['referral_code' => $this->ticket_number()]);
                // Auth::user()->referral_code =  $this->ticket_number();
            }

            if (Auth::user()->utype == 'VDR') {
                return redirect('vendor/dashboard');
            }

            // dd(Auth::user());
            return redirect('admin/dashboard');
        }
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function movewishlist($request)
    {
        if (Session::has('wishlist')) {

            foreach (Session::get('wishlist') as $id => $cart) {

                $wproduct = Wishlist::where('product_id', $cart['product_id'])->where('user_id', Auth::user()->id)->first();
                if ($wproduct) {
                    // session()->flash('info','Item alreday in wishlist!');
                    // return;
                } else {
                    $carModel = new Wishlist();
                    $carModel['user_id'] = Auth::user()->id;
                    $carModel['product_id'] = $cart['product_id'];
                    $carModel['product_name'] = $cart['product_name'];
                    $carModel['product_image'] = $cart['product_image'];
                    $carModel['quantity'] = $cart['quantity'];
                    $carModel['seller_id'] = $cart['seller_id'] ?? 1;
                    $carModel['price'] = $cart['price'];
                    $carModel->save();
                }
            }
            Session::forget('wishlist');
            return;
        }
        return;
    }

    public function movecart($request)
    {
        if (Session::has('cart')) {
            foreach (Session::get('cart') as $id => $cart) {
                $wproduct = Cart::where('product_id', $cart['product_id'])->where('user_id', Auth::user()->id)->first();
                if ($wproduct) {

                    // session()->flash('info','item alreday in Cart!');
                    // return;
                } else {

                    $carModel = new Cart();
                    $carModel['user_id'] = Auth::user()->id;
                    $carModel['product_id'] = $cart['product_id'];
                    $carModel['product_name'] = $cart['product_name'];
                    $carModel['product_image'] = $cart['product_image'];
                    $carModel['quantity'] = $cart['quantity'];
                    $carModel['seller_id'] = $cart['seller_id'] ?? 1;
                    $carModel['price'] = $cart['price'];
                    $carModel->save();
                }
            }
            Session::forget('cart');
            return;
        }

        return;
    }

    function ticket_number()
    {
        do {
            $rcode = Str::random(6);
            ;
        } while (User::where("referral_code", "=", $rcode)->first());

        return $rcode;
    }


}
