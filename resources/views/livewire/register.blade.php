@extends('layouts.main1')



@section('content')
    <div class="signup-section pt-120 pb-120">

        <div class="container">

            <div class="row d-flex justify-content-center">

                <div class="col-xl-6 col-lg-8 col-md-10">

                    <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s">

                        <div class="form-title">

                            <h3>Kisan Registration</h3>

                            <p>Do you already have an account? <a href="{{ route('vendorlogin') }}">Log in here</a></p>

                        </div>

                        <form class="w-100" method="POST" action="{{ route('udregisteor') }}" id="frmRegistar"
                            enctype="multipart/form-data" autocomplete="off">

                            @csrf

                            <div class="row">
                                <input name="type" type="hidden" value="{{ $type ?? '' }}">
                                <div class="col-md-6">

                                    <div class="form-inner">

                                        <label> Name *</label>

                                        <input class="form-control" value="{{ old('name') }}" name="name"
                                            placeholder="Full Name" type="text">

                                        @error('name')
                                            <div class="field_error text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-inner">

                                        <label>Contact Number *</label>

                                        <input name="phone" type="text" value="{{ old('phone') }}"
                                            placeholder="Number"class="form-control rounded checkIsNumber phone-check">

                                        @error('phone')
                                            <div class="field_error text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-12">

                                    <div class="form-inner">

                                        <label>Enter Your Email *</label>

                                        <input name="email" value="{{ old('email') }}" type="text" placeholder="Email"
                                            class="form-control rounded" autocomplete="off">

                                        @error('email')
                                            <div class="field_error text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-12">

                                    <div class="mb-3">

                                        <label>Choose a Vendor Plan *</label>

                                        <!-- Your select input with added id -->
                                        <select name="package" id="package" class="form-control">
                                            <option value="">Select one</option>
                                            @foreach ($packages as $package)
                                                <option value="{{ $package->id }}"
                                                    {{ old('package') == $package->id ? 'selected' : '' }}>
                                                    {{ $package->pname }}</option>
                                            @endforeach
                                        </select>


                                        @error('package')
                                            <div class="field_error text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-12">

                                    <div class="form-inner">

                                        <label>Password *</label>

                                        <input type="password" name="password" id="password"
                                            placeholder="Create A Password" />



                                        <i class="bi bi-eye-slash" id="togglePassword"></i>

                                    </div>

                                </div>

                                <div class="col-md-12">

                                    <div class="form-inner">

                                        <label>Confirm Password *</label>

                                        <input type="password" name="password_confirmation" id="password2"
                                            placeholder="Confirm Password" />

                                        <i class="bi bi-eye-slash" id="togglePassword2"></i>

                                    </div>

                                    @error('password')
                                        <div class="field_error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div id="checkboxed_error" class="field_error text-danger"></div>

                                <div id="thank_you_msg" class="field_error text-center text-success"></div>

                                <div id="register_msg" class= "msg-show text-center text-danger"></div>

                                <div class="col-md-12">

                                    <div class="form-agreement form-inner d-flex justify-content-between flex-wrap">

                                        <div class="form-group">

                                            <input type="checkbox" name="checkbox" value ="1" id="html" />

                                            <label for="html">I agree to the Terms & Condition</label>
                                            @error('checkbox')
                                                <div class="field_error text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <button type="submit" class="account-btn">Create Account</button>

                        </form>

                        <!--<div class="alternate-signup-box">-->

                        <!--    <h6>or signup WITH</h6>-->

                        <!--    <div class="btn-group gap-4">-->

                        <!--        <a href class="eg-btn google-btn d-flex align-items-center"><i class="bx bxl-google"></i><span>signup whit google</span></a>-->

                        <!--        <a href class="eg-btn facebook-btn d-flex align-items-center"><i class="bx bxl-facebook"></i>signup whit facebook</a>-->

                        <!--    </div>-->

                        <!--</div>-->

                        <div class="form-poicy-area">

                            <p>By clicking the "Create Account" button, you create an Utkarsh Kisan Vendor account, and you
                                agree to Utkarsh Kisan's <a href="{{ route('vendor-terms-and-conditions') }}">Vendor Terms
                                    &
                                    Conditions</a> & <a href="{{ route('privacy-policy') }}">Privacy Policy.</a></p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
