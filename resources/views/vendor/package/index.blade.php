@extends('layouts.vendor')

@section('content')
    <!-- sa-app__toolbar / end -->
    <!-- sa-app__body -->
    <div id="top" class="sa-app__body">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <style>
            .singlePrice {
                -webkit-transition: 0.4s;
                transition: 0.4s;
                padding: 33px 23px;
                border: 1px solid #D0D5DD;
                overflow: hidden !important;
                position: relative;
                border-radius: 12px;
                background: #fff;
                -webkit-box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05);
                box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05);
            }

            .mb-24 {
                margin-bottom: 24px;
            }

            .fadeInLeft {
                -webkit-animation-name: fadeInLeft;
                animation-name: fadeInLeft;
            }

            .singlePrice .priceTittle {
                -webkit-transition: 0.4s;
                transition: 0.4s;
                font-family: var(--heading-font);
                color: var #333333 (--heading-color);
                font-size: 24px;
                font-weight: 500;
                margin-bottom: 20px;
            }


            .singlePrice .listing .listItem:last-child {
                /* margin-bottom: 32px; */
                height: 84px;
            }

            .singlePrice .listing .listItem {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                font-family: var(--heading-font);
                color: #475467;
                margin-bottom: 22px;
                font-size: 16px;
            }

            .singlePrice .listing .listItem .icon {
                color: #4CAF50;
                margin-right: 15px;
                font-weight: 700;
            }

            .singlePrice .price {
                -webkit-transition: 0.4s;
                transition: 0.4s;
                color: var(--heading-color);
                font-size: 30px;
                font-weight: 700;
                font-family: var(--body-font);
                margin-bottom: 31px;
                display: block;
            }

            .singlePrice .price>.subTittle {
                font-family: var(--heading-font);
                font-weight: 400;
                color: #667085 !important;
                font-size: 16px;
                background: none;
                padding: 0;
            }

            .singlePrice:hover .priceTittle {
                color: var(--main-color-two);
            }

            .btn-wrapper .cmn-btn-outline1 {
                font-family: var(--heading-font);
                border: 1px solid #D0D5DD;
                color: #667085;
                font-size: 15px;
                font-weight: 500;
                text-transform: normal;
                padding: 14px 15px !important;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -moz-user-select: none;
                cursor: pointer;
                display: inline-block;
                position: relative;
                -webkit-transition: color 0.4s linear;
                transition: color 0.4s linear;
                position: relative;
                overflow: hidden;
                border-radius: 8px;
                background: none;
                z-index: 1;
                width: 100%;
                text-align: center;
            }
        </style>
        <div class="mx-xxl-3 px-4 px-sm-5">
            <div class="py-5">
                <div class="row g-4 align-items-center">
                    <div class="col">
                        <nav class="mb-2" aria-label="breadcrumb">

                        </nav>
                        <h1 class="h3 m-0">My Package</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
            <div class="sa-layout">
                <!-- <div class="sa-layout__backdrop" data-sa-layout-sidebar-close=""></div> -->

                <div class="sa-layout__content">
                    <div class="card">
                        <section class="pricingCard section-padding">
                            <div class="container">

                                @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                @endif
                                <div class="row p-5">

                                    @if ($vendor->vendorPackage)
                                        <div class="col-lg-4 col-md-6">
                                            <div class="singlePrice mb-24 wow fadeInLeft" data-wow-delay="0.0s">
                                                <h4 class="priceTittle">{{ $vendor->vendorPackage->package->pname }}</h4>
                                                <ul class="listing m-0 p-0">
                                                    <div class="listing-ptag">
                                                        {!! $vendor->vendorPackage->package->description !!}
                                                    </div>

                                                    {{-- <li class="listItem mt-3">
                                                        <i class="bi bi-check icon"></i>
                                                        <blockquote class="priceTag">
                                                            {{ $vendor->vendorPackage->package->count }} Count</blockquote>
                                                    </li> --}}

                                                    <li class="listItem">
                                                        <i class="bi bi-check icon"></i>
                                                        <blockquote class="priceTag">Valid Upto:
                                                            {{ \Carbon\Carbon::parse($vendor->vendorPackage->valid_upto)->format('d M Y') }}
                                                        </blockquote>
                                                    </li>
                                                </ul>

                                                <span class="price">
                                                    <i class="fa-solid fa-indian-rupee-sign"></i>
                                                    {{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", $vendor->vendorPackage->package->price) }}
                                                    <span class="subTittle"> /
                                                        {{ $vendor->vendorPackage->package->validity }} Days</span>
                                                </span>

                                                <div class="btn-wrapper">
                                                    <a href="#" class="cmn-btn-outline1 disabled">Active Package</a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-lg-4 col-md-6">

                                            <div class="singlePrice mb-24 wow fadeInLeft" data-wow-delay="0.0s">
                                                <h4 class="priceTittle">{{ $package->pname }}</h4>
                                                <ul class="listing m-0 p-0">
                                                    <div class="listing-ptag">
                                                        {!! $package->description !!}
                                                    </div>

                                                    {{-- <li class="listItem mt-3"><i class="bi bi-check icon"></i>
                                                        <blockquote class="priceTag">{{ $package->count }} Count
                                                        </blockquote>
                                                    </li> --}}
                                                </ul>
                                                <span class="price"><i class="fa-solid fa-indian-rupee-sign"></i>
                                                    {{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", $package->price) }}
                                                    <span class="subTittle"> /{{ $package->validity }} Days</span></span>
                                                <div class="btn-wrapper">
                                                    <a href="{{ route('razorpay.checkout', $package->pslug) }}"
                                                        class="cmn-btn-outline1">Buy Now</a>
                                                    {{-- <a href="#" wire:click.prevent="checklogin('{{$package->pslug}}')" class="cmn-btn-outline1">Get Started</a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
