@extends('layouts.main1')



@section('content')
    <div class="container">

        <div class="row justify-content-center py-5">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">{{ __('Admin Login') }}</div>



                    <div class="card-body">

                        <form method="POST" action="{{ route('adminlogin') }}">

                            @csrf



                            <div class="row mb-3">

                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>



                                <div class="col-md-6">

                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>



                                    @error('email')
                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $message }}</strong>

                                        </span>
                                    @enderror

                                </div>

                            </div>



                            <div class="row mb-3">

                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>



                                <div class="col-md-6">

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">



                                    @error('password')
                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $message }}</strong>

                                        </span>
                                    @enderror

                                </div>

                            </div>

                            <div id="login_msg">

                                @if (session('error'))
                                    <div
                                        style="color: #a94442; background-color: #f2dede; border: 1px solid #ebccd1; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>

                            <div class="row mb-3">

                                <div class="col-md-6 offset-md-4">

                                    <div class="form-check">

                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>



                                        <label class="form-check-label" for="remember">

                                            {{ __('Remember Me') }}

                                        </label>

                                    </div>

                                </div>

                            </div>



                            <div class="row mb-0">

                                <div class="col-md-8 offset-md-4">

                                    <button type="submit" class="btn btn-primary login_btn">

                                        {{ __('Login') }}

                                    </button>



                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">

                                            {{ __('Forgot Your Password?') }}

                                        </a>
                                    @endif

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
