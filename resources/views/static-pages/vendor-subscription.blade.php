@extends('layouts.main1')



@section('content')
 
  <div class="container">
   
     <div class="h1-service-area pt-40 mb-40">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="section-title1 text-center">
                        <span> <img src="{{ asset('assets/images/icon/section-vec-l1.svg') }}"
                                alt="" />Our Subscription Plans<img
                                src="{{ asset('assets/images/icon/section-vec-r1.svg') }}" alt="" /> </span>
                        <h2 class="word">Our Subscription Plans</h2>
                    </div>
                </div>
            </div>
            <div class="row g-4" style="padding-top:20px">
                <div class="col-lg-4 col-xl-4 col-md-6  col-sm-12 col-12">
                    <div class="services-card1">
                        <img class="services-card-vec mark-logo"
                            src="{{ asset('/assets/images/icon/mark-logo.svg') }}" alt="" />
                        <div class="icon">
                            <img src="{{ asset('assets/images/icon/daycare-center2.svg') }}"
                                alt="" />
                        </div>
                        <div class="content">
                            <h3><a href="#">1-Month Plan </a></h3>
                            <h4><a href="#" class="subscription_price">Price - ₹250 </a></h4>

                            <p>Perfect for Small Businesses Use only 250 INR and discover our platform. It is perfect when there is a small business, which wants to test the waters, get access to new customers and grow without long term commitment and without the pressure of the occasion.</p>
                        </div>
                        <!-- <a class="more-btn" href="#">More Details<img
                                src="{{ asset('assets/images/icon/btn-arrow1.svg') }}" alt="" /></a> -->
                    </div>
                </div>
                <div class="col-lg-4  col-xl-4 col-md-6 col-sm-12  col-12">
                    <div class="services-card1">
                        <img class="services-card-vec mark-logo"
                            src="{{ asset('/assets/images/icon/mark-logo.svg') }}" alt="" />
                        <div class="icon">
                            <img src="{{ asset('assets/images/icon/daycare-center2.svg') }}"
                                alt="" />
                        </div>
                        <div class="content">
                            <h3><a href="#">3-Month Plan </a></h3>
                            <h4><a href="#" class="subscription_price">Price - ₹500 </a></h4>
                            <p>Build Trust and Gain Customers To make your brand time and connect with more buyers, you have to spend just 500 (rupees). An intelligent decision to increase awareness, interaction and customer loyalty within 3 months.</p>
                        </div>
                        <!-- <a class="more-btn" href="#">More Details<img
                                src="{{ asset('assets/images/icon/btn-arrow1.svg') }}" alt="" /></a> -->
                    </div>
                </div>
                <div class="col-lg-4 col-xl-4 col-md-6 col-sm-12 col-12">
                    <div class="services-card1">
                        <img class="services-card-vec mark-logo"
                            src="{{ asset('/assets/images/icon/mark-logo.svg') }}" alt="" />
                        <div class="icon">
                            <img src="{{ asset('assets/images/icon/daycare-center2.svg') }}"
                                alt="" />
                        </div>
                        <div class="content">
                            <h3><a href="#">6-Month Plan</a></h3>
                            <h4><a href="#" class="subscription_price">Price - ₹800 </a></h4>
                            <p>Maximize Sales, Minimize Cost Extend your presence in India and enhance long-term performance at only 800 rupees. A plan that gives regular visibility and sales at a cost that is less than a cup of tea per day.</p>
                        </div>
                        <!-- <a class="more-btn" href="#">More Details<img
                                src="{{ asset('assets/images/icon/btn-arrow1.svg') }}" alt="" /></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

 


@endsection