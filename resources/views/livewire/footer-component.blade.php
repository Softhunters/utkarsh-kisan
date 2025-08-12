<footer class="style2">
    <div class="container">
        <div class="row pt-40 pb-40 justify-content-center mb-4">
            <div class="col-lg-3 col-md-3">
                <div class="footer-widget">
                    <div class="footer-icon  ">
                        <img src="{{ asset('admin/logos/utkarsh_logo.png') }}" style="width:200px;" class="foot" alt />
                    </div>
                    <div class="widget-title footer-text  text-center ">
                        <h5 style="width: 200px " class="text-center">

                            Utkarsh Kisan is a part of <span> VEER ENTERPRISES </span>
                        </h5>
                    </div>
                    <!-- <div class="footer-btn">
                            <a class="primary-btn6" href="#">Shop Now</a>
                        </div> -->
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="footer-widget one">
                    <div class="widget-title">
                        <h3>Useful Links</h3>
                    </div>
                    <div class="menu-container">
                        <ul>
                            <li><a href="/">Home</a></li>


                            <li><a href="{{ route('about-us') }}">About Us</a></li>
                            <!-- <li><a href="#">Shop</a></li> -->
                            <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                            <li><a href="{{ route('vdrregisterview') }}">Kisan Registration</a></li>
                            <li><a href="{{ route('user.account') }}">My Account</a></li>
                            <li><a href="{{ route('vendor-subscription') }}">Our Subscription</a></li>
                            <!-- <li><a href="#">Order Tracking</a></li>
                                <li><a href="#">Blogs -->
                            </a></li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="footer-widget one">
                    <div class="widget-title">
                        <h3>Help</h3>
                    </div>
                    <div class="menu-container">
                        <ul>
                            <!-- <li><a href="#">About Us</a></li>
                                <li><a href="#">FAQs</a></li> -->
                            <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('return-refund-policy') }}">Return & Refund Policy</a></li>
                            <li><a href="{{ route('terms-and-conditions') }}">Terms & Conditions</a></li>
                            <li><a href="{{ route('shipping-policy') }}">Shipping & Delivery Policy </a></li>
                            <li><a href="{{ route('vendor-terms-and-conditions') }}">Vendor Terms & Conditions </a>
                            </li>
                        </ul>
                        <div class="row mt-2">
                            <div class="col-4">
                                <div class="text-center">
                                    <a href="#"><img src="https://utkarshkisan.com/admin/logos/1752232312.png"
                                            style="width:30px;" class="foot" alt /></a><br>
                                    <span>User app</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center">
                                    <a href="#"><img src="https://utkarshkisan.com/admin/logos/1752232312.png"
                                            style="width:30px;" class="foot" alt /></a><br>
                                    <span>Vendor app</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 ">
                <div class="footer-widget one mb-0">
                    <div class="widget-title ">
                        <h3 class="mb-20">Contact Us</h3>
                    </div>
                    <div class="menu-container">
                        <ul class="details">
                            <li class="d-flex contact_foot">
                                <div class="hotline-icon">
                                    <img src="{{ asset('assets/images/phone-icon.svg') }}" alt>
                                </div>
                                <div class="hotline-info ms-2 text-center">
                                    <h6><a>{{ $setting->phone }}</a></h6>
                                </div>
                            </li>
                            <li class="d-flex contact_foot">
                                <div class="email-icon">

                                    <img src="{{ asset('assets/images/envelope.svg') }}" alt>
                                </div>
                                <div class="email-info ms-2 text-center">
                                    <h6><a>{{ $setting->email }}</a></h6>
                                </div>
                            </li>
                            <li class="d-flex contact_foot">
                                <div class="email-icon">
                                    <img src="{{ asset('assets/images/location.svg') }}" alt>
                                </div>
                                <div class="email-info ms-2 ">
                                    <h6><a>{{ $setting->address }}</a></h6>
                                    {{-- <h6 ><a>508, Madhyam Marg, Agarwal Farm, Sector 9, Mansarovar, Jaipur, Rajasthan 302020</a></h6> --}}
                                </div>
                            </li>

                        </ul>
                    </div>
                    {{-- <div class="download-link">
                            <ul>
                                <li>
                                    <a href="#"><img src="{{asset('assets/images/icon/google-play.svg')}}" alt /></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{asset('assets/images/icon/app-store.svg')}}" alt /></a>
                                </li>
                            </ul>
                        </div> --}}
                    <div class="social-area ">
                        <ul class="areas">
                            <li>
                                <a href="{{ $setting->facebook }}" target="_blank">
                                    <i class="bx bxl-facebook"></i>
                                    <!-- <img src="{{ asset('assets/images/logo/utkarsh_fb.png') }}" height="30" width="30" alt /> -->
                                </a>
                            </li>
                            <li>
                                <a href="{{ $setting->twiter }}" target="_blank">
                                    <i class="bx bxl-twitter"></i>
                                    <!-- <img src="{{ asset('assets/images/logo/utkarsh_x.png') }}" height="30" width="30" alt /> -->
                                </a>
                            </li>
                            <li>
                                <a href="{{ $setting->pinterest }}" target="_blank">
                                    <!-- <i class="bx bxl-pinterest-alt"></i>  -->
                                    <i class="bx bxl-youtube"></i>

                                    <!-- <img src="{{ asset('assets/images/logo/utkarsh_youtube.png') }}" height="30" width="30" alt /> -->
                                </a>
                            </li>
                            <li>
                                <a href="{{ $setting->instagram }}" target="_blank">
                                    <i class="bx bxl-instagram"></i>
                                    <!-- <img src="{{ asset('assets/images/logo/utkarsh_insta.png') }}" height="30" width="30" alt /> -->
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top align-items-center lower-footer">
            <div class="col-lg-6 col-md-6">
                <div class="copyright-area">
                    <p>© 2025, utkarsh kisan - All Rights Reserved | Developed by Softhunters Technology</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 d-flex justify-content-md-end justify-content-center">
                <div class="social-area">
                    <ul>
                        <li>
                            <a href="#"><img src="{{ asset('assets/images/icon/visa.svg') }}" alt /></a>
                        </li>
                        <li>
                            <a href="#"><img src="{{ asset('assets/images/icon/master-card.svg') }}" alt /></a>
                        </li>
                        <li>
                            <a href="#"><img src="{{ asset('assets/images/icon/amarican-ex.svg') }}" alt /></a>
                        </li>
                        <li>
                            <a href="#"><img src="{{ asset('assets/images/icon/maestro.svg') }}" alt /></a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</footer>
