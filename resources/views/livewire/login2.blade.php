@extends('layouts.main1')

@section('content')
    <div class="login-section pt-50 pb-90">
        <div class="container">
            <div class="row d-flex justify-content-center g-4">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s">
                        <div class="form-title">
                            <h3>Log In</h3>
                            {{-- <p>New Member? <a href="{{ route('new-user-register') }}">signup here</a></p> --}}
                        </div>

                        <form id="frmLogin" method="POST">
                            @csrf

                            <div id="loginStep">
                                <div class="form-inner">
                                    <label>Enter Your Phone Number *</label>
                                    <input type="text" name="number" id="number" class="form-control"
                                        placeholder="Enter your phone number" required>
                                </div>
                                <div id="login_msg" class="text-danger mt-2"></div>
                                <button type="submit" class="account-btn mt-3" id="sendOtpBtn">Send OTP</button>
                            </div>

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
                        </form>

                        <div class="form-poicy-area mt-3">
                            <p>By continuing, you agree to Utkarsh Kisan <a href="#">Terms & Conditions</a> & <a href="#">Privacy Policy</a>.</p>
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
                        $('#login_msg').text(res.message);
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
                            $('#otp_msg').text("Login successful. Redirecting...");

                            window.location.href = "/";
                        } else {
                            $('#otp_msg').text(res.message);
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
