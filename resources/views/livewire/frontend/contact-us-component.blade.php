<div>
    <div class="inner-page-banner">

        <!-- <div class="breadcrumb-vec-btm">
            <img class="img-fluid" src="{{ asset('assets/images/bg/inner-banner-btm-vec.png') }}" alt />
        </div> -->

        <div class="container">
            <div class="row justify-content-center align-items-center text-center">
                <div class="col-sm-6 align-items-center banner-data">
                    <div class="banner-content">
                        <h1>Contact Us</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="banner-img d-block ">

                        <!-- <div class="banner-img-bg">
                            <img class="img-fluid" src="{{ asset('assets/images/bg/inner-banner-vec.png') }}" alt />
                        </div> -->


                        <img class="img-fluid contact-banner-img" src="{{asset('assets/images/bg/inner-banner-img.png')}}" alt />

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-pages pt-120 mb-120">
        <div class="container">
            <div class="row align-items-center g-lg-4 gy-5">
                <div class="col-lg-5 col-md-5">
                    <div class="contact-left">
                        <div class="hotline mb-50">
                            <h3>Call Us Now</h3>
                            <div class="icon">
                                <img src="{{ asset('assets/images/icon/phone-icon4.svg') }}" alt />
                            </div>
                            <div class="info">
                                <h6><a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a></h6>
                                @if (isset($setting->phone2))
                                    <h6><a href="tel:{{ $setting->phone2 }}">{{ $setting->phone2 }}</a></h6>
                                @endif
                            </div>
                        </div>
                        <div class="hotline mb-50">
                            <h3>Email Us Now</h3>
                            <div class="icon">
                                <img src="{{ asset('assets/images/icon/email.svg') }}" alt />
                            </div>
                            <div class="info">
                                <h6><a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></h6>
                            </div>
                        </div>
                        <div class="location">
                            <h3>Address </h3>
                            <div class="icon">
                                <img src="{{ asset('assets/images/icon/location4.svg') }}" alt />
                            </div>
                            <div class="info">
                                <h6>
                                    <a href="#">
                                        {{ $setting->address }}
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="contact-form">
                        <h2>Have Any Questions</h2>
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form wire:submit.prevent="addContactform">
                            <div class="row">
                                <div class="col-lg-12 mb-30">
                                    <div class="form-inner">
                                        <input type="text" wire:model="name" placeholder="Enter your name" />
                                        @error('name') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-30">
                                    <div class="form-inner">
                                        <input type="text" wire:model="phone" placeholder="phone" />
                                        @error('phone') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-30">
                                    <div class="form-inner">
                                        <input type="text" wire:model="email" placeholder="Enter your email" />
                                        @error('email') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-30">
                                    <div class="form-inner">
                                        <input type="text" wire:model="subject" placeholder="Subject" />
                                        @error('subject') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-30">
                                    <div class="form-inner">
                                        <textarea wire:model="message" placeholder="Your message"></textarea>
                                        @error('message') <p class="text-danger">{{$message}}</p> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-inner">
                                        <button class="primary-btn1" type="submit">Send Message <i
                                                class="bi bi-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="location-map">
        {{-- <div class="vector">
            <img src="{{ asset('assets/images/bg/map-vector.png') }}" alt />
        </div> --}}
        <iframe src="{{ $setting->map }}" style="border: 0;" allowfullscreen loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
