<!DOCTYPE html>
<html lang="en" dir="ltr" data-scompiler-id="0">
<!-- Mirrored from stroyka-admin.html.themeforest.scompiler.ru/variants/ltr/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 May 2023 05:16:53 GMT -->

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="format-detection" content="telephone=no" />
    <title>Pet Shope </title>
    <!-- icon -->
    <!-- {{ asset('admin/css/animate.css') }} -->
    <link rel="icon" type="image/png" href="{{ asset('admin1/images/favicon.png') }}" />
    <!-- fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" />
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('admin1/vendor/bootstrap/css/bootstrap.ltr.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin1/vendor/highlight.js/styles/github.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin1/vendor/simplebar/simplebar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin1/vendor/quill/quill.snow.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin1/vendor/air-datepicker/css/datepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin1/vendor/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin1/vendor/datatables/css/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin1/vendor/nouislider/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin1/vendor/fullcalendar/main.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin1/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin1/css/font-awesome.min') }}" />


    @yield('page_css')

    @livewireStyles
    <!-- <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-97489509-8"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "UA-97489509-8");
    </script> -->
</head>

<body>
    <!-- sa-app -->
    <div class="sa-app sa-app--desktop-sidebar-shown sa-app--mobile-sidebar-hidden sa-app--toolbar-fixed">
        <!-- sa-app__sidebar -->
        <div class="sa-app__sidebar">
            <div class="sa-sidebar">
                <div class="sa-sidebar__header" style="height:10%;">
                    <a class="sa-sidebar__logo" href="{{ route('admin.dashboard') }}">
                        <!-- logo -->
                        <div class="sa-sidebar-logo">
                            <img src="{{ asset('assets/images/header2-logo (1).png') }}" alt="images"
                                style="width: 180px;height: 100px;">

                        </div>
                        <!-- logo / end -->
                    </a>
                </div>
                <div class="sa-sidebar__body" data-simplebar="">
                    <ul class="sa-nav sa-nav--sidebar" data-sa-collapse="">
                        <li class="sa-nav__section">
                            <!--<div class="sa-nav__section-title"><span>Application</span></div>-->
                            <ul class="sa-nav__menu sa-nav__menu--root">
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="{{ route('admin.dashboard') }}" class="sa-nav__link side1 side2">
                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/1.png') }}">
                                        <span class="sa-nav__title">Dashboard</span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger="">
                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/2.png') }}">
                                        <span class="sa-nav__title">Category</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.addcategory') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Add Category</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.categories') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Category List</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.subcategories') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Sub Category List</span></a>
                                        </li>
                                        {{-- <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.subsubcategories') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Sub SubCategory List</span></a>
                                        </li> --}}

                                    </ul>
                                </li>



                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger="">
                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/3.png') }}">
                                        <span class="sa-nav__title">User</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        {{--  <li class="sa-nav__menu-item">
                                            <a href="{{route('admin.adduser')}}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Add User</span></a>
                                        </li> --}}
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.users') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">User List</span></a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger="">
                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/3.png') }}">
                                        <span class="sa-nav__title">Vendor</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        {{--  <li class="sa-nav__menu-item">
                                            <a href="{{route('admin.adduser')}}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Add User</span></a>
                                        </li> --}}
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('vendor.list', 'active') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Active Vendor List</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('vendor.list', 'deactivated') }}"
                                                class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Deactivated Vendor List</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('vendor.list', 'unverified') }}"
                                                class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Unverified Vendor List</span></a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger="">
                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/4.png') }}">
                                        <span class="sa-nav__title">Product</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.addproduct2') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Add Product</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.products2') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Product List</span></a>
                                        </li>


                                    </ul>
                                </li>




                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger="">
                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/6.png') }}">
                                        <span class="sa-nav__title">Attribute</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.addattribute') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Add Attribute</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.attributes') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Attribute List</span></a>
                                        </li>


                                    </ul>
                                </li>

                                {{--  <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link" data-sa-collapse-trigger="">
                                        <i class="fa fa-file-alt me-4"></i>
                                        <span class="sa-nav__title">Attribute's Options</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="{{route('admin.addattributeoption')}}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Add Attribute's Options</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="{{route('admin.attributeoptions')}}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Attribute's Option List</span></a>
                                        </li>


                                    </ul>
                                </li> --}}








                                {{-- <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger="">


                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/7.png') }}">

                                        <span class="sa-nav__title">Slider</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.addslider') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Add Slider</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.sliders') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Slider</span></a>
                                        </li>

                                    </ul>
                                </li> --}}

                                {{-- <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger="">


                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/8.png') }}">

                                        <span class="sa-nav__title">Banner</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.addbanner') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Add Banner</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.banners') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Banner</span></a>
                                        </li>

                                    </ul>
                                </li> --}}
                                {{-- <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger="">


                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/9.png') }}">

                                        <span class="sa-nav__title">Review</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.active-reviews') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Active Reviews</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.deactive-reviews') }}"
                                                class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Deactive Reviews</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.reviews') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Reviews</span></a>
                                        </li>

                                    </ul>
                                </li> --}}
                                {{-- <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger="">


                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/10.png') }}">

                                        <span class="sa-nav__title">Questions</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">


                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.question-answers') }}"
                                                class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Question-Answers</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.questions') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Questions</span></a>
                                        </li>
                                    </ul>
                                </li> --}}
                                {{-- <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger="">


                                        <img class="sidebaar2" src="{{ asset('assets/img/logo/order.png') }}">

                                        <span class="sa-nav__title">Order</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">

                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.orders') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Orders</span></a>
                                        </li>

                                    </ul>
                                </li> --}}
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger="">


                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/11.png') }}">

                                        <span class="sa-nav__title">Tax</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.addtax') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Add Tax</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.taxs') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Tax</span></a>
                                        </li>

                                    </ul>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger="">


                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/12.png') }}">

                                        <span class="sa-nav__title">Coupon</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.addcoupon') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Add Coupon</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.coupons') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Coupon</span></a>
                                        </li>

                                    </ul>
                                </li>

                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger="">
                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/13.png') }}">
                                        <span class="sa-nav__title">Brand</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.addbrand') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Add Brand</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.brands') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Brand</span></a>
                                        </li>


                                    </ul>
                                </li>

                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    {{-- <a href="{{ route('admin.flavours') }}" class="sa-nav__link side1 side2">
                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/16.png') }}">
                                        <span class="sa-nav__title">Flavours</span>
                                    </a> --}}
                                </li>
                                {{-- <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger=""> 
                                         <img class="sidebaar2" style="width:20px;" src="{{asset('assets/images/logo/20.png')}}" >
                                        <span class="sa-nav__title">Prescription</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="{{route('admin.prescription')}}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">view Prescription </span></a>
                                        </li>
                                    </ul>
                                </li> --}}
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger="">
                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/18.png') }}">
                                        <span class="sa-nav__title">Settings</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.websetting') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Web site setting </span></a>
                                        </li>
                                        {{-- <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.rewardsetting') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Reward Point setting </span></a>
                                        </li> --}}
                                    </ul>
                                </li>

                                {{-- <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger="">
                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/19.png') }}">
                                        <span class="sa-nav__title">Testimonial</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.addtestimonial') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Add Testimonial</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.testimonials') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">Testimonial</span></a>
                                        </li>


                                    </ul>
                                </li> --}}
                                {{-- <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                    data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link side1 side2" data-sa-collapse-trigger="">
                                        <img class="sidebaar2" style="width:20px;"
                                            src="{{ asset('assets/images/logo/17.png') }}">
                                        <span class="sa-nav__title">Contact-Form</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="{{ route('admin.contact-form') }}" class="sa-nav__link"><span
                                                    class="sa-nav__menu-item-padding"></span><span
                                                    class="sa-nav__title">forms</span></a>
                                        </li>
                                    </ul>
                                </li> --}}
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="sa-app__sidebar-shadow"></div>
            <div class="sa-app__sidebar-backdrop" data-sa-close-sidebar=""></div>
        </div>
        <!-- sa-app__sidebar / end -->
        <!-- sa-app__content -->
        <div class="sa-app__content">
            <!-- sa-app__toolbar -->
            <div class="sa-toolbar sa-toolbar--search-hidden sa-app__toolbar">
                <div class="sa-toolbar__body">
                    <div class="sa-toolbar__item">
                        <button class="sa-toolbar__button" type="button" aria-label="Menu"
                            data-sa-toggle-sidebar="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path d="M1,11V9h18v2H1z M1,3h18v2H1V3z M15,17H1v-2h14V17z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="sa-toolbar__item sa-toolbar__item--search">
                        <form class="sa-search sa-search--state--pending">
                            <div class="sa-search__body">
                                <label class="visually-hidden" for="input-search">Search for:</label>
                                <div class="sa-search__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        viewBox="0 0 16 16" fill="currentColor">
                                        <path
                                            d="M16.243 14.828C16.243 14.828 16.047 15.308 15.701 15.654C15.34 16.015 14.828 16.242 14.828 16.242L10.321 11.736C9.247 12.522 7.933 13 6.5 13C2.91 13 0 10.09 0 6.5C0 2.91 2.91 0 6.5 0C10.09 0 13 2.91 13 6.5C13 7.933 12.522 9.247 11.736 10.321L16.243 14.828ZM6.5 2C4.015 2 2 4.015 2 6.5C2 8.985 4.015 11 6.5 11C8.985 11 11 8.985 11 6.5C11 4.015 8.985 2 6.5 2Z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="text" id="input-search" class="sa-search__input"
                                    placeholder="Search for the truth" autocomplete="off" />
                                <button class="sa-search__cancel d-sm-none" type="button" aria-label="Close search">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 12 12" fill="currentColor">
                                        <path
                                            d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6 c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4 C11.2,9.8,11.2,10.4,10.8,10.8z">
                                        </path>
                                    </svg>
                                </button>
                                <div class="sa-search__field"></div>
                            </div>
                            <div class="sa-search__dropdown">
                                <div class="sa-search__dropdown-loader"></div>
                                <div class="sa-search__dropdown-wrapper">
                                    <div class="sa-search__suggestions sa-suggestions"></div>
                                    <div class="sa-search__help sa-search__help--type--no-results">
                                        <div class="sa-search__help-title">No results for &quot;<span
                                                class="sa-search__query"></span>&quot;</div>
                                        <div class="sa-search__help-subtitle">Make sure that all words are spelled
                                            correctly.</div>
                                    </div>
                                    <div class="sa-search__help sa-search__help--type--greeting">
                                        <div class="sa-search__help-title">Start typing to search for</div>
                                        <div class="sa-search__help-subtitle">Products, orders, customers, actions,
                                            etc.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sa-search__backdrop"></div>
                        </form>
                    </div>
                    <div class="mx-auto"></div>
                    <div class="sa-toolbar__item d-sm-none">
                        <button class="sa-toolbar__button" type="button" aria-label="Show search"
                            data-sa-action="show-search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                viewBox="0 0 16 16" fill="currentColor">
                                <path
                                    d="M16.243 14.828C16.243 14.828 16.047 15.308 15.701 15.654C15.34 16.015 14.828 16.242 14.828 16.242L10.321 11.736C9.247 12.522 7.933 13 6.5 13C2.91 13 0 10.09 0 6.5C0 2.91 2.91 0 6.5 0C10.09 0 13 2.91 13 6.5C13 7.933 12.522 9.247 11.736 10.321L16.243 14.828ZM6.5 2C4.015 2 2 4.015 2 6.5C2 8.985 4.015 11 6.5 11C8.985 11 11 8.985 11 6.5C11 4.015 8.985 2 6.5 2Z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="dropdown sa-toolbar__item">
                        <button class="sa-toolbar-user" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" data-bs-offset="0,1" aria-expanded="false">
                            <span class="sa-toolbar-user__avatar sa-symbol sa-symbol--shape--rounded"><img
                                    src="{{ asset('admin1/images/customers/customer-4-64x64.jpg') }}" width="64"
                                    height="64" alt="" /></span>
                            <span class="sa-toolbar-user__info"><span class="sa-toolbar-user__title">Konstantin
                                    Veselovsky</span><span
                                    class="sa-toolbar-user__subtitle">stroyka@example.com</span></span>
                        </button>
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="app-inbox-list.html">Inbox</a></li>
                            <li><a class="dropdown-item" href="app-settings-toc.html">Settings</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="las la-sign-out-alt icon"></i>Logout</a></li>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
                <div class="sa-toolbar__shadow"></div>
            </div>
            <!-- sa-app__toolbar / end -->
            <!-- sa-app__body -->



            {{ $slot }}



            <!-- sa-app__body / end -->
            <!-- sa-app__footer -->
            <div class="sa-app__footer d-block d-md-flex">
                <!-- copyright -->Stroyka Admin — eCommerce Dashboard Template © 2021
                <div class="m-auto"></div>
                <div>Powered by HTML — Design by <a href="https://themeforest.net/user/kos9/portfolio">Kos</a></div>
                <!-- copyright / end -->
            </div>
            <!-- sa-app__footer / end -->
        </div>
        <!-- sa-app__content / end -->
        <!-- sa-app__toasts -->
        <div class="sa-app__toasts toast-container bottom-0 end-0"></div>
        <!-- sa-app__toasts / end -->
    </div>
    <!-- sa-app / end -->
    <!-- scripts -->
    <script src="{{ asset('admin1/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin1/vendor/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin1/vendor/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin1/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin1/vendor/highlight.js/highlight.pack.js') }}"></script>
    <script src="{{ asset('admin1/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('admin1/vendor/air-datepicker/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('admin1/vendor/air-datepicker/js/i18n/datepicker.en.js') }}"></script>
    <script src="{{ asset('admin1/vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin1/vendor/fontawesome/js/all.min.js') }}" data-auto-replace-svg="" async=""></script>
    <script src="{{ asset('admin1/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('admin1/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin1/vendor/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin1/vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('admin1/vendor/fullcalendar/main.min.js') }}"></script>
    <script src="{{ asset('admin1/js/stroyka.js') }}"></script>
    <script src="{{ asset('admin1/js/custom.js') }}"></script>
    <script src="{{ asset('admin1/js/calendar.js') }}"></script>
    <script src="{{ asset('admin1/js/demo.js') }}"></script>
    <script src="{{ asset('admin1/js/demo-chart-js.js') }}"></script>
    @livewireScripts
    @stack('scripts')
</body>
<!-- Mirrored from stroyka-admin.html.themeforest.scompiler.ru/variants/ltr/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 May 2023 05:17:29 GMT -->

</html>
