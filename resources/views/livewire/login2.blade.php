@extends('layouts.main1')



@section('content')

    <div class="login-section pt-50 pb-90">

        <div class="container">

            <div class="row d-flex justify-content-center g-4">

                <div class="col-xl-6 col-lg-8 col-md-10">

                    <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s">

                        <div class="form-title">

                            <h3>Log In</h3>

                            <p>New Member? <a href="{{route('new-user-register')}}">signup here</a></p>

                        </div>

                        <form class="w-100" action="#" id="frmLogin" method="post">

                        @csrf

                            <div class="row">

                                <div class="col-12">

                                    <div class="form-inner">

                                        <label>Enter Your Email or Phone Number *</label>

                                        <input type="email" name ="email" placeholder="Enter Your Email" />

                                    </div>

                                </div>

                                {{--<div class="col-12">

                                    <div class="form-inner">

                                        <label>Password *</label>

                                        <input type="password" name="password" id="password" placeholder="Password" />

                                        <i class="bi bi-eye-slash" id="togglePassword"></i>

                                    </div>

                                </div>
                                --}}

                                <div id="login_msg" style="color:black;"></div>

                                <div class="col-12">

                                    <div class="form-agreement form-inner d-flex justify-content-between flex-wrap">

                                        <div class="form-group">

 
                                            <input type="checkbox"  name="checkbox" value ="1" id="html" />

                                            <label for="html">Remember Me </a></label>

                                        </div>

                                      

                                        <a href="{{ route('password.request') }}" class="forgot-pass">Forgotten Email</a>

                                    </div>

                                </div>

                            </div>

                            <button class="account-btn">Log in</button>

                        </form>

                        <!--<div class="alternate-signup-box">-->

                        <!--    <h6>or signup WITH</h6>-->

                        <!--    <div class="btn-group gap-4">-->

                        <!--        <a href class="eg-btn google-btn d-flex align-items-center"><i class="bx bxl-google"></i><span>signup whit google</span></a>-->

                        <!--        <a href class="eg-btn facebook-btn d-flex align-items-center"><i class="bx bxl-facebook"></i>signup whit facebook</a>-->

                        <!--    </div>-->

                        <!--</div>-->

                        <div class="form-poicy-area">

                            <p>By clicking the "signup" button, you create a Petshop account, and you agree to Petshop's <a href="#">Terms & Conditions</a> & <a href="#">Privacy Policy.</a></p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    @push('scripts')

    <script>

        jQuery('#frmLogin').submit(function(e){

        jQuery('#login_msg').html("");

        e.preventDefault();

        jQuery.ajax({

            url:'{{ route('ulogin') }}',

            data:jQuery('#frmLogin').serialize(),

            type:'post',

            success:function(result){

            if(result.status=="error"){

                jQuery('#login_msg').html(result.msg);

            }

            if(result.status=="success"){

            // window.location.reload();

            window.location.href="/";



            }

            }

        });

        });

    </script>

    @endpush

    @endsection