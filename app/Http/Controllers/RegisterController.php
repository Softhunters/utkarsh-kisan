<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;


class RegisterController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric', 'digits:10', 'unique:users'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'utype' => isset($data['type']) ? $data['type'] : 'USR',
            'referral_code' => $this->ticket_number(),
        ]);
    }


    public function uregisteor(Request $request)
    {
        dd($request->all());
        $valid = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric', 'digits:10', 'unique:users'],
            'package' => 'required',
            'checkbox' => 'required'
        ]);

        if (!$valid->passes()) {
            return response()->json([
                'status' => 'error',
                'error' => $valid->errors()->toArray()
            ]);
        }

        // Create the user
        $user = $this->create($request->all());

        // If user type is vendor, create a vendor profile row
        if ($request->type === 'VDR') {
            VendorProfile::create([
                'vendor_id' => $user->id,
                'package_id' => $request->package_id,
                'status' => 0
            ]);
        }

        session(['user_id' => $user->id]);


        // Fire the registration event
        event(new Registered($user));


        return response()->json([
            'status' => 'success',
            'msg' => "Thank you for your interest in Utkarsh Kisan – now you can login."
        ]);
    }

    public function vdrregisterview(Request $request)
    {
        $type = 'VDR';
        $packages = Package::where('status', 1)->get();
        return view('livewire.register', compact('type', 'packages'));
    }
    public function uregisteorview(Request $request)
    {
        return view('livewire.register');
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
