  
@extends('layouts.main1')

@section('content')

<div class="login-section pt-50 pb-90">
    <div class="container">
        <div class="row d-flex justify-content-center g-4">
            <div class="col-xl-5 col-lg-8 col-md-10">
                <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s">
                    <div class="form-title">
                        <h3 class="otp_verify">Verify OTP</h3>
                        <p class="otp_text">Please enter the 6-digit OTP sent to your registered email or phone number.</p>
                    </div>

                    <form class="w-100" id="frmOtpVerify" method="post" action="#">
                        @csrf

                        {{-- <div class="form-inner mb-3">
                            <label>Email or Phone *</label>
                            <input type="text" name="email_or_phone" placeholder="Email or Phone Number" />
                        </div> --}}

                        <div class="form-inner mb-3">
                            {{-- <label>Enter OTP *</label> --}}
                            <div class="d-flex justify-content-center gap-2 otp-inputs">
                                @for ($i = 1; $i <= 6; $i++)
                                    <input type="text" maxlength="1" class="otp-digit form-control text-center" name="otp[]" required>
                                @endfor
                            </div>
                        </div>

                        <div id="otp_msg" style="color:black;" class="mb-2"></div>

                        <div class="text-end mb-3">
                            <a href="#" id="resendOtp" class="resend_otp">Resend OTP</a>
                        </div>

                        <button class="account-btn" type="submit">Verify OTP</button>

                        <div class="form-poicy-area mt-3">
                            <p>By verifying, you agree to our <a href="{{route('terms-and-conditions')}}">Terms & Conditions</a> and <a href="{{route('privacy-policy')}}">Privacy Policy.</a></p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
 
@push('scripts')
{{-- <script>
    // Move to next input
    document.querySelectorAll('.otp-digit').forEach((input, index, inputs) => {
        input.addEventListener('input', (e) => {
            if (e.target.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === "Backspace" && input.value === '' && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });

    // Handle form submit
    jQuery('#frmOtpVerify').submit(function(e) {
        e.preventDefault();
        jQuery('#otp_msg').html("");

        let emailOrPhone = jQuery('input[name="email_or_phone"]').val();
        let otpDigits = [];
        jQuery('.otp-digit').each(function () {
            otpDigits.push(jQuery(this).val());
        });

        let otp = otpDigits.join('');

        jQuery.ajax({
            url: '{{ route('verifyOtp') }}',
            type: 'post',
            data: {
                _token: '{{ csrf_token() }}',
                email_or_phone: emailOrPhone,
                otp: otp
            },
            success: function(result) {
                if (result.status === "error") {
                    jQuery('#otp_msg').html(result.msg);
                }

                if (result.status === "success") {
                    window.location.href = "/";
                }
            }
        });
    });

    jQuery('#resendOtp').click(function(e) {
        e.preventDefault();
        let emailOrPhone = jQuery('input[name="email_or_phone"]').val();

        if (!emailOrPhone) {
            jQuery('#otp_msg').html("Please enter your email or phone to resend OTP.");
            return;
        }

        jQuery.ajax({
            url: '{{ route('resendOtp') }}',
            type: 'post',
            data: {
                _token: '{{ csrf_token() }}',
                email_or_phone: emailOrPhone
            },
            success: function(result) {
                jQuery('#otp_msg').html(result.msg);
            }
        });
    });
</script> --}}
@endpush

@endsection
