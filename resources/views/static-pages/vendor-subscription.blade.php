@extends('layouts.main1')



@section('content')
    <div class="container">

        <div class="h1-service-area pt-40 mb-40">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <div class="section-title1 text-center">
                            <span> <img src="{{ asset('assets/images/icon/section-vec-l1.svg') }}" alt="" />Our
                                Subscription Plans<img src="{{ asset('assets/images/icon/section-vec-r1.svg') }}"
                                    alt="" /> </span>
                            <h2 class="word">Our Subscription Plans</h2>
                        </div>
                    </div>
                </div>
                <div class="row g-4" style="padding-top:20px">
                    @foreach ($packages as $package)
                        <div class="col-lg-4 col-xl-4 col-md-4 col-12">
                            <div class="services-card1">
                                <img class="services-card-vec mark-logo"
                                    src="{{ asset('/assets/images/icon/mark-logo.svg') }}" alt="" />
                                <!--<div class="icon">-->
                                <!--    <img src="{{ asset('assets/images/icon/daycare-center2.svg') }}"-->
                                <!--        alt="" />-->
                                <!--</div>-->
                                <div class="content">
                                    <h3><a href="#">🌾 {{ $package->pname }} </a></h3>
                                    <h4><a href="#" class="subscription_price">Price - ₹{{ $package->price }}/year
                                        </a></h4>

                                    {!! $package->description !!}
                                </div>

                                <div class="d-flex justify-content-center">
                                    <a class="primary-btn1 py-1 px-3 border-0" href="{{ route('buy-package') }}">Buy Now</a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="col-lg-4 col-xl-4 col-md-4 col-12">
                        <div class="services-card1">
                            <img class="services-card-vec mark-logo" src="{{ asset('/assets/images/icon/mark-logo.svg') }}"
                                alt="" />
                            <!--<div class="icon">-->
                            <!--    <img src="{{ asset('assets/images/icon/daycare-center2.svg') }}"-->
                            <!--        alt="" />-->
                            <!--</div>-->
                            <div class="content">
                                <h3><a href="#">🌾 Farmer Plan </a></h3>
                                <h4><a href="#" class="subscription_price">Price - ₹299/year </a></h4>

                                <p>Perfect for individual farmers looking to grow their reach and sell their produce
                                    directly to customers and bulk buyers.</p>
                                <ul>
                                    <li>Your personal online store on UtkarshKisan</li>
                                    <li>Free listing of your products</li>
                                    <li>Shop poster designs to promote your store locally</li>
                                    <li>Direct customer data from Meta Ads to grow your buyer network</li>
                                    <li>Zero commission on every sale</li>
                                </ul>
                                <p>One-time yearly payment. No middlemen. No extra fees.</p>
                            </div>

                            <div class="d-flex justify-content-center">
                                <a class="primary-btn1 py-1 px-3 border-0" href="{{ route('buy-package') }}">Buy Now</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-4 col-md-4 col-12">
                        <div class="services-card1">
                            <img class="services-card-vec mark-logo" src="{{ asset('/assets/images/icon/mark-logo.svg') }}"
                                alt="" />
                            <!--<div class="icon">-->
                            <!--    <img src="{{ asset('assets/images/icon/daycare-center2.svg') }}"-->
                            <!--        alt="" />-->
                            <!--</div>-->
                            <div class="content">
                                <h3><a href="#">🏭 Basic Manufacturer Plan</a></h3>
                                <h4><a href="#" class="subscription_price">Price - ₹8,999/year </a></h4>
                                <p>Tailored for agri-based manufacturers and factory owners who want to scale their business
                                    online and reach high-intent buyers nationwide.</p>
                                <ul>
                                    <li>Unlimited product listings</li>
                                    <li>Factory-level promotional poster designs</li>
                                    <li>Customer data leads from targeted Meta Ads</li>
                                    <li>Zero commission on all orders</li>
                                    <li>Priority support and onboarding assistance</li>
                                </ul>
                                <p>Grow your factory business online — without giving away a share of your profits.</p>
                            </div>

                            <div class="d-flex justify-content-center">
                                <a class="primary-btn1 py-1 px-3 border-0" href="{{ route('buy-package') }}">Buy Now</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-4 col-md-4 col-12">
                        <div class="services-card1">
                            <img class="services-card-vec mark-logo" src="{{ asset('/assets/images/icon/mark-logo.svg') }}"
                                alt="" />
                            <!--<div class="icon">-->
                            <!--    <img src="{{ asset('assets/images/icon/daycare-center2.svg') }}"-->
                            <!--        alt="" />-->
                            <!--</div>-->
                            <div class="content">
                                <h3><a href="#">🏭 Premium Manufacturer Plan</a></h3>
                                <h4><a href="#" class="subscription_price">Price - ₹15,999/year </a></h4>
                                <p>Tailored for agri-based manufacturers and factory owners who want to scale their business
                                    online and reach high-intent buyers nationwide.</p>
                                <ul>
                                    <li>You will get a portfolio website</li>
                                    <li>Unlimited product listings</li>
                                    <li>Factory-level promotional poster designs</li>
                                    <li>Customer data leads from targeted Meta Ads</li>
                                    <li>Zero commission on all orders</li>
                                    <li>Priority support and onboarding assistance</li>
                                </ul>
                                <p>Grow your factory business online — without giving away a share of your profits.</p>
                            </div>

                            <div class="d-flex justify-content-center">
                                <a class="primary-btn1 py-1 px-3 border-0" href="{{ route('buy-package') }}">Buy Now</a>
                            </div>

                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
@endsection
