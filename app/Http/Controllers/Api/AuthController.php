<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\VendorProfile;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;



class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'referral_code' => $this->ticket_number(),
            'device_token' => $data['device_token'],
            'utype' => isset($data['utype']) ? $data['utype'] : 'USR',
        ]);
    }

    public function createUser(Request $request)
    {
        try {
            //Validated

            $valid = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'phone' => ['required', 'numeric', 'digits:10', 'unique:users'],
                'device_token' => 'required'
            ]);
            if (!$valid->passes()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $valid->errors()
                ], 200);
            } else {

                event(new Registered($user = $this->create($request->all())));
                session(['user_id' => $user->id]);
                return response()->json([
                    'status' => true,
                    'message' => 'User Created Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
            }


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function uloginauth(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required',
                    'device_token' => 'required',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if ($this->attemptLogin($request)) {

                if (Auth::user()->status == 0 || Auth::user()->is_active == 3) {
                    Auth::logout();
                    return response()->json([
                        'status' => false,
                        'message' => 'Your account is blocked or deactivated. Please contact support',
                    ], 200);
                }

                if ($request->hasSession()) {
                    $request->session()->put('auth.password_confirmed_at', time());
                }


                // Auth::user()->update(['device_token'=>$request->token]);
                User::find(Auth::user()->id)->update(['device_token' => $request->token]);
                if (!isset(Auth::user()->referral_code)) {
                    User::where('id', Auth::user()->id)->update(['referral_code' => $this->ticket_number()]);
                }
                $user = Auth::user();
                session(['user_id' => Auth::id()]);
                return response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
            } else {

                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 200);
            }


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function ApplyRcode(Request $request)
    {
        try {
            // $validateUser = Validator::make($request->all(), 
            // [
            //     'rcode' => ['required', 'string', 'min:6']
            // ]);

            // if($validateUser->fails()){
            //     return response()->json([
            //         'status' => false,
            //         'message' => 'validation error',
            //         'errors' => $validateUser->errors()
            //     ], 200);
            // }

            $check = User::where('referral_code', $request->rcode)->where('id', '!=', Auth::user()->id)->first();
            if (isset($check)) {
                User::where('id', Auth::user()->id)->update(['referral_by' => $request->rcode]);
                // session()->flash('success', 'Referral Code has been applied successfully');
                return response()->json([
                    'status' => true,
                    'message' => 'Referral Code has been applied successfully',

                ], 200);
            } else {
                // session()->flash('error','Referral Code not Found!');
                return response()->json([
                    'status' => false,
                    'message' => 'Referral Code not Found!.',
                ], 200);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function chnagePassword(Request $request)
    {

        $userd = DB::table('users')->where('public_id', Auth::user()->public_id)->first();

        $fg = (Hash::check($request->old_password, $userd->password));
        if ($fg) {

            $status = DB::table('users')->where('public_id', $userd->public_id)->update([
                'password' => Hash::make($request->password),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Password Updated !!'
            ], 200);
            // return redirect('/logout')->with('status', 'Password Updated !!');
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Password not matched !!'
            ], 200);
            //  return redirect('/')->with('status', 'Password not matched !!');
        }

    }
    public function PasswordUpdate(Request $request)
    {
        $valid = Validator::make($request->all(), ['password' => ['required', 'string', 'min:8'], 'new_password' => ['required', 'string', 'min:8']]);
        if (!$valid->passes()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $valid->errors()
            ], 200);
        } else {
            $fg = (Hash::check($request->password, Auth::user()->password));
            if ($fg) {
                $status = User::where('id', Auth::user()->id)->update(['password' => Hash::make($request->new_password)]);
                return response()->json([
                    'status' => true,
                    'message' => 'Password Updated !!'
                ], 200);

            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Password not matched !!'
                ], 200);

            }
        }
    }

    public function checkEmail(Request $request)
    {
        // dd($request);

        try {
            //Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                    'user_type' => 'required',
                    'email' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = DB::table('users')->where('status', 1)->where('user_type', $request->user_type)->where('email', $request->email)->first();

            if ($user) {
                $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
                $onetimepassword = substr(str_shuffle($data), 0, 8);
                //print_r($onetimepassword);
                $possw = Hash::make($onetimepassword);
                //dd($onetimepassword);
                $status = DB::table('users')->where('public_id', $user->public_id)->update([
                    'password' => $possw,
                ]);
                //dd($status);
                $email = $request->email;
                $mailData = [
                    'title' => 'Forgot Password',
                    'name' => $user->name,
                    'rand_id' => $onetimepassword,
                ];
                $hji = 'forgot_password';
                $subject = 'Forgot Password';
                Mail::to($email)->send(new EmailDemo($mailData, $hji, $subject));

                $notifi = new NotificationController;
                $notifi->mobilesmsotlp($mailData, $user->mobile_number);

                return response()->json([
                    'status' => true,
                    'message' => 'Email verified email sent successfully!!',

                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid email',

                ], 401);
            }


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::user()->update(['device_token' => '']);
        // $result = Auth::user()->id;
        $userd = User::find(Auth::user()->id);
        $userd->device_token = NULL;
        $userd->save();
        //$status = DB::table('users')->where('public_id', Auth::user()->public_id)->update(['device_token'=>NULL]);
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'logged out !!',

        ], 200);
    }

    public function Profile(Request $request)
    {
        $user_detail = Auth::user();
        return response()->json([
            'status' => true,
            'result' => $user_detail
        ], 200);
    }

    public function profileUpdate(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 200);
        }

        User::where('id', Auth::id())->update(['email' => $request->email, 'name' => $request->name]);

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully'
        ], 200);
    }
    public function profileUpdate2(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 200);
        }

        // User::where('id', Auth::id())->update(['email' => $request->email, 'name' => $request->name]);

        $user = User::findOrFail(Auth::id());
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();

        event(new Registered($user));

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully'
        ], 200);
    }

    public function ReverifyAccountOTP(Request $request)
    {
        try {
            $otp = rand(111111, 999999);
            $token = Str::random(64);

            UserVerify::create([
                'user_id' => Auth::user()->id,
                'token' => $token,
                'mobile_opt' => $otp
            ]);

            $email = Auth::user()->email;

            $mailData = [
                'title' => 'Register Request Submit',
                'name' => Auth::user()->name,
                'token' => $otp
            ];
            $notifi = new NotificationController;
            $notifi->mobilesmsotpvefiy($mailData, Auth::user()->mobile_number);
            return response()->json([
                'status' => true,
                'message' => 'Verification OTP sent successfully!!',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function verifyAccountotp(Request $request)
    {

        $verifyUser = UserVerify::where('mobile_opt', $request->token)->where('user_id', Auth::user()->id)->first();
        //   dd($verifyUser);

        $message = 'Sorry Your OTP does not matched.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->is_mobile_verified) {
                $verifyUser->user->is_mobile_verified = 1;
                $verifyUser->user->save();
                $message = "Your Mobile is verified. You can now login.";
            } else {
                $message = "Your Mobile is already verified. You can now login.";
            }
            return response()->json([
                'status' => true,
                'message' => $message,
                'token' => $request->token
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => $message,
            'token' => $request->token
        ], 200);
    }
    public function Accountdelete(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'other_info' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }



            $user = User::find(Auth::user()->id)->update(['status' => 4, 'delete_reason' => $request->other_info]);
            return response()->json([
                'status' => true,
                'message' => 'User Deleted Successfully !'
            ], 200);


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    function ticket_number()
    {
        do {
            $rcode = Str::random(6);
            ;
        } while (User::where("referral_code", "=", $rcode)->first());

        return $rcode;
    }


    public function OtpLogin(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'number' => 'required',
                    'otp' => 'required',
                    'device_token' => 'required',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 200);
            }

            $userc = User::where('phone', $request->number)->first();


            if (isset($userc)) {
                if ($userc->utype != 'USR') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Access denied. Your account is registered for the Vendor app and cannot be used to log in to the user app.'
                    ], 200);
                }
                if ($userc->otp == $request->otp) {
                    Auth::login($userc);
                    if (Auth::user()->status == 0 || Auth::user()->is_active == 3) {
                        Auth::logout();
                        return response()->json([
                            'status' => false,
                            'message' => 'Your account is blocked or deactivated. Please contact support',
                        ], 200);
                    }
                    User::find(Auth::user()->id)->update(['device_token' => $request->token, 'otp' => null]);
                    if (!isset(Auth::user()->referral_code)) {
                        User::where('id', Auth::user()->id)->update(['referral_code' => $this->ticket_number()]);
                    }
                    $user = Auth::user();
                    session(['user_id' => Auth::id()]);

                    $this->movewishlist($request);
                    $this->movecart($request);

                    $profile = (Auth::user()->name == $request->number) ? true : false;

                    return response()->json([
                        'status' => true,
                        'message' => 'User Logged In Successfully',
                        'token' => $user->createToken("API TOKEN")->plainTextToken,
                        'profile' => $profile,
                    ], 200);

                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'The OTP you entered is incorrect. Please try again.'
                    ], 200);

                }

            } else {

                return response()->json([
                    'status' => false,
                    'message' => 'This Mobile is number not register!'
                ], 200);
            }


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }



    public function vcreateUser(Request $request)
    {
        try {
            //Validated

            $valid = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'phone' => ['required', 'numeric', 'digits:10', 'unique:users'],
                'device_token' => 'required',
                'package' => 'required',
                'utype' => 'required'
            ]);
            if (!$valid->passes()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $valid->errors()
                ], 200);
            } else {

                event(new Registered($user = $this->create($request->all())));

                if ($user->utype === 'VDR') {
                    VendorProfile::create([
                        'vendor_id' => $user->id,
                        'package_id' => $request->package,
                        'status' => 0
                    ]);
                }

                return response()->json([
                    'status' => true,
                    'message' => 'User Created Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
            }


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function vloginauth(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required',
                    'device_token' => 'required',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if ($this->attemptLogin($request)) {
                if ($request->hasSession()) {
                    $request->session()->put('auth.password_confirmed_at', time());
                }

                if (Auth::user()->utype !== 'VDR') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Email & Password does not match with our record.',
                    ], 200);

                }

                // Auth::user()->update(['device_token'=>$request->token]);
                User::find(Auth::user()->id)->update(['device_token' => $request->token]);
                if (!isset(Auth::user()->referral_code)) {
                    User::where('id', Auth::user()->id)->update(['referral_code' => $this->ticket_number()]);
                }

                $user = Auth::user();
                $isVenPack = ($user->vendorPackage) ? true : false;

                return response()->json([
                    'status' => true,
                    'isSubscriptionBuy' => $isVenPack,
                    'message' => 'User Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
            } else {

                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 200);
            }


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function VGenrateOtp(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'number' => 'required|numeric|digits:10'
                ],
                [
                    'number.required' => 'Please enter your phone number.',
                    'number.numeric' => 'Phone number must contain only digits.',
                    'number.digits' => 'Please enter a valid phone number.',
                ]
            );


            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 200);
            }

            $user = User::where('phone', $request->number)->first();
            if (isset($user)) {
                if ($user->utype != 'VDR') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Access Denied: This phone number is registered for the User Panel and cannot be used to log in to the Vendor Panel.'
                    ], 200);
                }
                // $otp= rand(100000, 999999);
                $otp = "123456";
                User::where('phone', $request->number)->where('utype', 'VDR')->update(['otp' => $otp]);

                // sendOtp($request->number, $otp);

                return response()->json([
                    'status' => true,
                    'message' => '6 digit Otp send to your registor mobile number!',
                    'otp' => $otp
                ], 200);
            } else {


                return response()->json([
                    'status' => false,
                    'message' => 'The mobile number you entered is not registered with us. Please check the number or sign up to create a new account.'
                ], 200);
            }


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function GenrateOtp(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'number' => 'required|numeric|digits:10'
                ],
                [
                    'number.required' => 'Please enter your phone number.',
                    'number.numeric' => 'Phone number must contain only digits.',
                    'number.digits' => 'Please enter a valid phone number.',
                ]
            );


            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 200);
            }

            $user = User::where('phone', $request->number)->first();
            if (isset($user)) {
                if ($user->utype != 'USR') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Access Denied: This phone number is registered for the Vendor Panel and cannot be used to log in to the User Panel.'
                    ], 200);
                }
                // $otp = rand(100000, 999999);
                $otp = "123456";
                User::where('phone', $request->number)->where('utype', 'USR')->update(['otp' => $otp]);

                // sendOtp($request->number, $otp);

                return response()->json([
                    'status' => true,
                    'message' => "We've sent a 6-digit OTP to your registered mobile number.",
                    'otp' => $otp
                ], 200);
            } else {

                User::create([
                    'name' => $request->number,
                    'email' => $request->number . '@gmail.com',
                    'phone' => $request->number,
                    'password' => Hash::make($request->number),
                ]);

                // $otp = rand(100000, 999999);
                $otp = '123456';

                User::where('phone', $request->number)->where('utype', 'USR')->update(['otp' => $otp]);

                // sendOtp($request->number, $otp);

                return response()->json([
                    'status' => true,
                    'message' => "We've sent a 6-digit OTP to your registered mobile number.",
                    'otp' => $otp
                ], 200);

            }


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
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

    public function VOtpLogin(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'number' => 'required',
                    'otp' => 'required',
                    'device_token' => 'required',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 200);
            }

            $userc = User::where('phone', $request->number)->where('utype', 'VDR')->first();
            if (isset($userc)) {
                if ($userc->utype != 'VDR') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Access denied. Your account is registered for the User app and cannot be used to log in to the Vendor app.'
                    ], 200);
                }
                if ($userc->otp == $request->otp) {
                    Auth::login($userc);

                    User::find(Auth::user()->id)->update(['device_token' => $request->token, 'otp' => null]);
                    if (!isset(Auth::user()->referral_code)) {
                        User::where('id', Auth::user()->id)->update(['referral_code' => $this->ticket_number()]);
                    }
                    $user = Auth::user();
                    $isVenPack = ($user->vendorPackage) ? true : false;

                    return response()->json([
                        'status' => true,
                        'isSubscriptionBuy' => $isVenPack,
                        'message' => 'You have successfully logged in',
                        'token' => $user->createToken("API TOKEN")->plainTextToken
                    ], 200);

                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'The OTP you entered is incorrect. Please try again!'
                    ], 200);

                }

            } else {

                return response()->json([
                    'status' => false,
                    'message' => 'This Mobile is number not registor!'
                ], 200);
            }


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}