@php
    // $wdata = webdata();
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <title>UTKARSH KISAN</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('admin/logos') }}" type="image/gif" sizes="20x20" />
    <meta name="description" content="UTKARSH KISAN">


    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/boxicons.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/odometer.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/datepicker.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/uiicss.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <!--<link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" type="text/css" media="all" />-->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="{'https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&amp;family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet"> -->
    @yield('page_css')

    @livewireStyles
    @livewireScripts
    <style>
        .flashmessgae {
            position: fixed;
            /* left: 40%; */
            top: 20%;
            /* bottom: 10%; */
            /*width: auto;*/
            text-align: center;
            right: 0;
            z-index: 999;

        }
    </style>

    <style>
        .badge {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            z-index: 2;
            position: absolute;
            right: -4px;
            top: -8px;
            height: 18px;
            min-width: 18px;
            border-radius: 27px;
            background: black;
            padding: 0;
            left: auto;
        }

        .btn .badge {
            position: relative;
            top: -1px;
        }

        .badge-secondary {
            color: #fff;
            /* background: linear-gradient(90deg, #F86CA7 0%, #FF7F18 100%); */
            background:linear-gradient(90deg, #4a7737 0%, #699a39 50%, #e9ad16 100%) !important;
        }

        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
            -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            -o-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        }
    </style>
</head>

<body class="home-pages-2">
    <!--<div class="top-bar-header">-->
    <!--    <div class="container-fluid">-->
    <!--        <div class="row">-->
    <!--            <div class="text-center p-2">-->
    <!--                <span>Avail a flat 20% discount (on MRP) up to Rs. 2000 on a minimum purchase of Rs. 5,000 using ICICI Bank Net Banking.</span>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <div class="top-bar two">
        <div class="container container-fluid">
            <div class="row">
                @livewire('frontend.header-search-component')
            </div>
        </div>
    </div>

    <section>
        <div class="mobile-headers d-lg-none d-md-none d-block">
            <div class="container-fluid theme-container">
                <ul class="menu-list d-flex justify-content-around">
                    <li class="menu-item"><a href="/" class="d-flex flex-column">
                            <img class="sidebaar2 icons" src="{{ asset('assets/images/logo/home01.png') }}">
                            <span class="menu-name">Home</span>
                        </a></li>
                    <li class="menu-item sidebar-button "><a href="#" class="d-flex flex-column">
                            <img class="sidebaar2 icons" src="{{ asset('assets/images/logo/catagories02.png') }}">
                            <span class="menu-name">Categories</span>
                        </a></li>
                    <!-- <li class="menu-item"><a href="#" data-toggle="modal" data-dismiss="modal" data-target="#search_modal" class="d-flex flex-column">
                <img class="sidebaar2 icons" src="{{ asset('assets/images/logo/search03.png') }}" >
                <span class="menu-name">Search</span>
                </a></li> -->
                    <li class="menu-item"><a href="#" class="d-flex flex-column">
                            <img class="sidebaar2 icons" src="{{ asset('assets/images/logo/discount05.png') }}">
                            <span class="menu-name">Offer</span>
                        </a></li>
                    <li class="menu-item"><a href="" class="d-flex flex-column">
                            <img class="sidebaar2 icons" src="{{ asset('assets/images/logo/account04.png') }}">
                            <span class="menu-name">Account</span>
                        </a></li>
                </ul>
            </div>
        </div>
    </section>

    <div class="modal clean_modal clean_modal-lg bg-white" id="search_modal" tabindex="-1"
        aria-labelledby="search_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
                <!--       <span aria-hidden="true">&times;</span>-->
                <!--   </button>-->
                <div class="row">
                    <div class="col-12">
                        <form action="">
                            <input class="form-control custom-search" style="bottom:380px;" name="search"
                                value="" placeholder="Search for Medicines and Health Products" type="text"
                                wire:model="searchj" wire:keyup="productcheck">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewire('nav-bar-component')
    @yield('content')

    @livewire('footer-component')

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nice-select.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/js/morphext.min.js') }}"></script>
    <script src="{{ asset('assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.marquee.min.js') }}"></script>
    <script src="{{ asset('assets/js/viewport.jquery.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nice-number.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <!--    <script src="https://thinkpureindia.jaipurdreams.com/assets/js/jquery-2.2.4.min.js"></script>-->
    <!--<script src="https://thinkpureindia.jaipurdreams.com/assets/js/plugins.bundle.js"></script>-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
    <!-- Modify theme scripts (Do not remove) -->
    <!--<script src="https://thinkpureindia.jaipurdreams.com/assets/js/theme.js"></script>-->
    @stack('scripts')
</body>

</html>
