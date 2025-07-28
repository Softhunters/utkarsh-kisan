@extends('layouts.main1')

@section('content')
    <div class="login-section pt-50 pb-90">
        <div class="container">
            <div class="row d-flex justify-content-center g-4">
                <div class="col-xl-5 col-lg-8 col-md-10">
                    <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s">
                        <div class="form-title">
                            <h3>Log In</h3>
                        </div>

                        <form id="frmLogin" method="POST">
                            @csrf

                            {{-- Step 1: Enter phone number --}}
                            <div id="loginStep">
                                <div class="form-inner">
                                    <label>Enter Your Phone Number *</label>
                                    <input type="text" name="number" id="number" class="form-control"
                                        placeholder="Enter your phone number" required>
                                </div>
                                <div id="login_msg" class="text-danger mt-2"></div>
                                <button type="submit" class="account-btn mt-3" id="sendOtpBtn">Send OTP</button>
                            </div>

                            {{-- Step 2: Enter OTP --}}
                            <div id="otpStep" class="d-none">
                                <div class="form-inner mb-3">
                                    <div class="d-flex justify-content-between gap-2 otp-inputs">
                                        @for ($i = 1; $i <= 6; $i++)
                                            <input type="text" maxlength="1" class="otp-digit form-control text-center"
                                                name="otp[]">
                                        @endfor
                                    </div>
                                </div>

                                <div id="otp_msg" class="text-success mb-2"></div>

                                <div class="text-end mb-3">
                                    <a href="#" id="resendOtp" class="resend_otp">Resend OTP</a>
                                </div>

                                <button type="button" class="account-btn" id="verifyOtpBtn">Verify OTP</button>
                            </div>

                            {{-- Step 3: Enter Name and Email --}}
                            <div id="profileStep" class="d-none">
                                <div class="form-inner">
                                    <label>Your Name *</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter your name">
                                    <div id="profile_name_msg" class="text-danger mt-2"></div>

                                </div>
                                <div class="form-inner mt-3">
                                    <label>Your Email *</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Enter your email">
                                    <div id="profile_email_msg" class="text-danger mt-2"></div>

                                </div>


                                <button type="button" class="account-btn mt-3" id="updateProfileBtn">Continue</button>
                            </div>
                        </form>

                        <div class="form-poicy-area mt-3">
                            <p>By continuing, you agree to Utkarsh Kisan <a href="#">Terms & Conditions</a> & <a
                                    href="#">Privacy Policy</a>.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let generatedOtp = "";

            function sendOtp(number, callback) {
                $.ajax({
                    url: '/api/get-otp',
                    type: 'POST',
                    data: {
                        number: number,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res.status) {
                            generatedOtp = res.otp;
                        }
                        if (typeof callback === 'function') {
                            callback(res);
                        }
                    }
                });
            }

            $('#frmLogin').on('submit', function(e) {
                e.preventDefault();
                const number = $('#number').val();

                sendOtp(number, function(res) {
                    if (res.status) {
                        $('#login_msg').text(res.message);
                        $('#loginStep').hide();
                        $('#otpStep').removeClass('d-none');
                    } else {
                        $('#login_msg').text(res.errors.number);
                    }
                });
            });

            $('#resendOtp').on('click', function(e) {
                e.preventDefault();
                const number = $('#number').val();

                sendOtp(number, function(res) {
                    if (res.status) {
                        $('#otp_msg').text("New OTP sent!");
                    } else {
                        $('#otp_msg').text(res.message);
                    }
                });
            });

            $('#verifyOtpBtn').on('click', function() {
                const number = $('#number').val();
                const userOtp = $('.otp-digit').map(function() {
                    return $(this).val();
                }).get().join('');

                const device_token = 'web_token_123';

                $.ajax({
                    url: '/mobile-login',
                    method: 'POST',
                    data: {
                        number: number,
                        otp: userOtp,
                        device_token: device_token,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res.status) {
                            if (res.profile) {
                                $('#otpStep').hide();
                                $('#profileStep').removeClass('d-none');
                            } else {
                                $('#otp_msg').text("Login successful. Redirecting...");
                                window.location.href = "/";
                            }
                        } else {
                            $('#otp_msg').text(res.errors.otp);
                        }
                    }
                });
            });

            $('#updateProfileBtn').on('click', function() {
                const name = $('#name').val();
                const email = $('#email').val();

                $.ajax({
                    url: '/profile/update2',
                    method: 'POST',
                    data: {
                        name: name,
                        email: email,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res.status) {
                            $('#profile_msg').text("Profile updated. Redirecting...");
                            window.location.href = "/";
                        } else {
                            $('#profile_name_msg').text(res.errors.name);
                            $('#profile_email_msg').text(res.errors.email);
                        }
                    }
                });
            });

            $(document).on('keyup', '.otp-digit', function() {
                if (this.value.length === 1) {
                    $(this).next('.otp-digit').focus();
                }
            });
        </script>
    @endpush
@endsection
