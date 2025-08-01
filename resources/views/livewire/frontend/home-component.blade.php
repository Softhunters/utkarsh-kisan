<div>
    <style>
        .collection-card .collection-content p {
            margin-bottom: 0;
            height: 35px;
            /*overflow:hidden;*/
            line-height: 21px;

        }

        .collection-card .collection-content a {

            color: var(--text-color1);
        }
    </style>
    @include('flash-message')
    <div class="hero3 mb-90">
        <div class="background-text">
            <h2 class="marquee_text">
                <img src="{{ asset('assets/images/icon/mark-logo.svg') }}" alt="image" class="mark-logo" /><span>No
                    Middlemen ,
                    Just Pure Goodness</span>
                <img src="{{ asset('assets/images/icon/mark-logo.svg') }}" alt="image" class="mark-logo" /><span> Best
                    Quality, Best prices
                </span>
            </h2>
        </div>
        @if (isset($sliders[0]))
            <div class="swiper hero3-slider">
                <div class="swiper-wrapper">
                    @foreach ($sliders as $slider)
                        <div class="swiper-slide">
                            <div class="hero-wrapper">
                                <!--<div class="container">-->
                                <div>
                                    <a href="{{ $slider->link }}">

                                        <img class="img-fluid banner-imgas"
                                            src="{{ asset('admin/slider') }}/{{ $slider->images }}" alt />

                                    </a>
                                </div>
                                <!--</div>-->
                            </div>
                        </div>
                    @endforeach
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        @endif
        <div class="right-sidebar">
            <div class="slider-pagination-area">
                <!--<div class="h3-hero-slider-pagination"></div>-->
            </div>
        </div>
    </div>
    <div class="home3-categoty-area pt-40 mb-40">
        <div class="container">
            <div class="row mb-60">
                <div class="col-lg-12 d-flex align-items-center justify-content-between flex-wrap gap-3 utkrsh_title">
                    <div class="section-title3 align-items-center  ">
                        <h2><img class="kishan_left" src="{{ asset('assets/images/icon/utkarsh-kisan_bg.png') }}"
                                width="40" height="40" alt /><span class="word">Browse By Categories</span><img
                                src="{{ asset('assets/images/icon/utkarsh-kisan_bg.png') }}" width="40"
                                height="40" alt /></h2>
                    </div>
                    <div class="slider-btn-wrap">
                        <div class="slider-btn prev-btn-11">
                            <i class="bi bi-arrow-left"></i>
                        </div>
                        <div class="slider-btn next-btn-11">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="swiper h3-category-slider" wire:ignore>
                        <div class="swiper-wrapper">
                            @foreach ($categorys as $category)
                                <div class="swiper-slide">
                                    <div class="category-card">
                                        <a href="{{ route('product.category', ['category_slug' => $category->slug]) }}"
                                            class="category-card-inner">
                                            {{-- <a href="#" class="category-card-inner"> --}}
                                            <div class="category-card-front">
                                                <div class="category-icon">
                                                    <img src="{{ asset('admin/category/icon') }}/{{ $category->icon }}"
                                                        alt />
                                                </div>
                                                <div class="content">
                                                    <p>{{ $category->name }}</p>
                                                </div>
                                            </div>
                                            <div class="category-card-back">
                                                <img src="{{ asset('admin/category/icon') }}/{{ $category->icon }}"
                                                    alt />
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($subcategorys as $scategory)
                                <div class="swiper-slide">
                                    <div class="category-card">
                                        <a href="{{ route('product.category', ['category_slug' => $scategory->category->slug, 'scategory_slug' => $scategory->slug]) }}"
                                            class="category-card-inner">
                                            {{-- <a href="#" class="category-card-inner"> --}}
                                            <div class="category-card-front">
                                                <div class="category-icon">
                                                    <img src="{{ asset('admin/category/icon') }}/{{ $scategory->icon }}"
                                                        alt />
                                                </div>
                                                <div class="content">
                                                    <p>{{ $scategory->name }}</p>
                                                </div>
                                            </div>
                                            <div class="category-card-back">
                                                <img src="{{ asset('admin/category/icon') }}/{{ $scategory->icon }}"
                                                    alt />
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="home3-collection-area mb-40">
        <div class="container">

            <div class="row g-4 justify-content-center">

                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-3 col-6">
                        <div class="collection-card">
                            <div class="offer-card">
                                @if ($product->discount_value != 0)
                                    <span>{{ $product->discount_value }}% Off</span>
                                @endif
                            </div>
                            @if ($product->stock_status == 'outofstock')
                                <span class=" bg-white rounded-sm inline-block text-center solded">Sold Out</span>
                            @endif
                            <div class="collection-img @if ($product->stock_status == 'outofstock') blured @endif">
                                <a href="{{ route('product-details', ['slug' => $product->slug]) }}"><img
                                        class="img-gluid"
                                        src="{{ asset('admin/product/feat') }}/{{ $product->image }}" alt=""
                                        height="136px" width="153px" /> </a>
                                {{-- <a href="#"><img class="img-gluid" src="{{asset('admin/product/feat')}}/{{$product->image}}" alt="" height="136px" width="153px" /> </a> --}}
                                <div class="view-dt-btn">
                                    <div class="plus-icon">
                                        <i class="bi bi-plus"></i>
                                    </div>
                                    <a href="{{ route('product-details', ['slug' => $product->slug]) }}">View
                                        Details</a>
                                    {{-- <a href="#">View Details</a> --}}
                                </div>
                                <ul class="cart-icon-list">
                                    <li>
                                        @if (in_array($product->id, $cartp))
                                            <!--<a href="#"><img src="{{ asset('assets/images/icon/Icon-cart3.svg') }}" alt /></a>-->
                                        @else
                                            <a href="#"
                                                wire:click.prevent="AddtoCart({{ $product->id }},{{ $product->bestSeller->price }},{{ $product->bestSeller->vendor_id ?? '' }})"><img
                                                    src="{{ asset('assets/images/icon/Icon-cart3.svg') }}" alt /></a>
                                        @endif
                                    </li>
                                    <li>
                                        @if (in_array($product->id, $wishp))
                                            <a href="#"
                                                wire:click.prevent="removeFromWishlist({{ $product->id }},{{ $product->bestSeller->vendor_id ?? '' }})"><img
                                                    src="{{ asset('assets/images/icon/Icon-favorites3.svg') }}"
                                                    alt /></a>
                                        @else
                                            <a href="#"
                                                wire:click.prevent="addToWishlist({{ $product->id }},{{ $product->bestSeller->price }},{{ $product->bestSeller->vendor_id ?? '' }})"><img
                                                    src="{{ asset('assets/images/icon/Icon-favorites.svg') }}"
                                                    alt /></a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="collection-content text-center">
                                <p class="fixed">
                                    <a
                                        href="{{ route('product-details', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                    {{-- <a href="#">{{$product->name}}</a> --}}
                                </p>
                                <div class="price priceds">
                                    <h6>₹{{ $product->bestSeller->price }}</h6>
                                    <del>₹{{ $product->regular_price }}</del>
                                </div>
                                <div class="review">
                                    @php
                                        if (isset($product->reviews)) {
                                            $ratingAvg = $product->reviews->avg('rating');
                                            $ratingAv = $ratingAvg;
                                            $ratingCount = $product->reviews->count();
                                        } else {
                                            $ratingAvg = 0;
                                            $ratingCount = 0;
                                        }
                                    @endphp
                                    <ul>
                                        @foreach (range(1, 5) as $i)
                                            @if ($ratingAvg > 0)
                                                @if ($ratingAvg > 0.5)
                                                    <li><i class="bi bi-star-fill"></i></li>
                                                @else
                                                    <li><i class="bi bi-star-half"></i></li>
                                                @endif
                                            @else
                                                <li><i class="bi bi-star"></i></li>
                                            @endif
                                            @php $ratingAvg--; @endphp
                                        @endforeach
                                    </ul>


                                    {{-- <span>{{number_format($ratingAv,2)}}  ({{$ratingCount}})</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="row d-md-none d-block pt-30">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="h3-view-btn">
                        <a href="{{ route('shop') }}">View All Product<img
                                src="{{ asset('assets/images/icon/haf-button-2.svg') }}" alt /></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (isset($banners[0]))
        <div class="h3-offer-area mb-40">
            <div class="container-fluid p-0 overflow-hidden">
                <div class="row">
                    <div class="col-lg-6 p-0">
                        <!--<div class="offer-left">-->
                        <!--<div class="offer-content">-->
                        <a href="{{ $banners[0]->link }}">
                            <img class="" src="{{ asset('admin/banner') }}/{{ $banners[0]->images }}" alt
                                height="100%" width="100%" />
                        </a>
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    <div class="col-lg-6 p-0 ">
                        <div class="offer-right">
                            <div class="slider-btn-wrap">
                                <div class="slider-btn prev-btn-15 mb-40">
                                    <i class="bi bi-arrow-up"></i>
                                </div>
                                <div class="slider-btn next-btn-15">
                                    <i class="bi bi-arrow-down"></i>
                                </div>
                            </div>

                            <div class="row position-relative">
                                <div class="swiper h3-offer-slider">
                                    <div class="swiper-wrapper">
                                        @foreach ($banners as $banner)
                                            <div class="swiper-slide">
                                                <a href="{{ $banner->link }}">
                                                    <img class=""
                                                        src="{{ asset('admin/banner') }}/{{ $banner->images }}" alt
                                                        height="100%" width="100%" />
                                                </a>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="essential-items-area mb-40">
        <div class="container">
            <div class="row mb-60">
                <div class="col-lg-12 d-flex align-items-center justify-content-between flex-wrap gap-3 utkrsh_title">
                    <div class="section-title3">
                        <h2><img class="kishan_left" src="{{ asset('assets/images/icon/utkarsh-kisan_bg.png') }}"
                                width="40" height="40" alt /><span class="word">Featured Items</span><img
                                src="{{ asset('assets/images/icon/utkarsh-kisan_bg.png') }}" width="40"
                                height="40" alt /></h2>
                    </div>
                    <div class="slider-btn-wrap">
                        <div class="slider-btn prev-btn-12">
                            <i class="bi bi-arrow-left"></i>
                        </div>
                        <div class="slider-btn next-btn-12">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="swiper essential-items-slider" wire:ignore>
                        <div class="swiper-wrapper">
                            @foreach ($fproducts as $fproduct)
                                <div class="swiper-slide">
                                    <div class="collection-card">
                                        <div class="offer-card">
                                            @if ($fproduct->discount_value != 0)
                                                <span>{{ $fproduct->discount_value }}% Off</span>
                                            @endif
                                        </div>
                                        @if ($fproduct->stock_status == 'outofstock')
                                            <span class=" bg-white rounded-sm inline-block text-center solded">Sold
                                                Out</span>
                                        @endif
                                        <div class="collection-img @if ($fproduct->stock_status == 'outofstock') blured @endif">
                                            <a href="{{ route('product-details', ['slug' => $fproduct->slug]) }}"><img
                                                    class="img-gluid"
                                                    src="{{ asset('admin/product/feat') }}/{{ $fproduct->image }}"
                                                    alt height="136px" width="153px" /></a>
                                            {{-- <a href="#"><img
                                                    class="img-gluid"
                                                    src="{{ asset('admin/product/feat') }}/{{ $fproduct->image }}" alt
                                                    height="136px" width="153px" /></a> --}}
                                            <div class="view-dt-btn">
                                                <div class="plus-icon">
                                                    <i class="bi bi-plus"></i>
                                                </div>
                                                <a href="{{ route('product-details', ['slug' => $fproduct->slug]) }}">View
                                                    Details</a>
                                                {{-- <a href="#">View Details</a> --}}
                                            </div>
                                            <ul class="cart-icon-list">
                                                <li>
                                                    @if (in_array($fproduct->id, $cartp))
                                                        <!--<a href="#"><img src="{{ asset('assets/images/icon/Icon-cart3.svg') }}" alt /></a>-->
                                                    @else
                                                        <a href="#"
                                                            wire:click.prevent="AddtoCart({{ $fproduct->id }},{{ $fproduct->bestSeller->price }},{{ $fproduct->bestSeller->vendor_id ?? '' }})"><img
                                                                src="{{ asset('assets/images/icon/Icon-cart3.svg') }}"
                                                                alt /></a>
                                                    @endif
                                                </li>
                                                <li>
                                                    @if (in_array($fproduct->id, $wishp))
                                                        <a href="#"
                                                            wire:click.prevent="removeFromWishlist({{ $fproduct->id }},{{ $fproduct->bestSeller->vendor_id ?? '' }})"><img
                                                                src="{{ asset('assets/images/icon/Icon-favorites3.svg') }}"
                                                                alt /></a>
                                                    @else
                                                        <a href="#"
                                                            wire:click.prevent="addToWishlist({{ $fproduct->id }},{{ $fproduct->bestSeller->price }},{{ $fproduct->bestSeller->vendor_id ?? '' }})"><img
                                                                src="{{ asset('assets/images/icon/Icon-favorites.svg') }}"
                                                                alt /></a>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="collection-content">
                                            <p class="fixed">
                                                <a
                                                    href="{{ route('product-details', ['slug' => $fproduct->slug]) }}">{{ $fproduct->name }}</a>
                                                {{-- <a href="#">{{ $fproduct->name }}</a> --}}
                                            </p>
                                            <div class="price priceds">
                                                <h6>₹{{ $fproduct->bestSeller->price }}</h6>
                                                <del>₹{{ $fproduct->regular_price }}</del>
                                            </div>
                                            <div class="review">
                                                @php
                                                    if (isset($fproduct->reviews)) {
                                                        $ratingAvg = $fproduct->reviews->avg('rating');
                                                        $ratingAv = $ratingAvg;
                                                        $ratingCount = $fproduct->reviews->count();
                                                    } else {
                                                        $ratingAvg = 0;
                                                        $ratingCount = 0;
                                                    }
                                                @endphp
                                                <ul>
                                                    @foreach (range(1, 5) as $i)
                                                        @if ($ratingAvg > 0)
                                                            @if ($ratingAvg > 0.5)
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                            @else
                                                                <li><i class="bi bi-star-half"></i></li>
                                                            @endif
                                                        @else
                                                            <li><i class="bi bi-star"></i></li>
                                                        @endif
                                                        @php $ratingAvg--; @endphp
                                                    @endforeach
                                                </ul>
                                                {{-- <span>{{ number_format($ratingAv, 2) }} ({{ $ratingCount }})</span> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="offer-banner-area mb-40">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-6 col-sm-8">
                    <div class="offer-banner-card">
                        <div class="offer-img d-lg-none d-flex justify-content-center">
                            <img src="{{ asset('assets/images/bg/wheet_img.png') }}" height="100px" alt />
                        </div>
                        <div class="offer-content">
                            <h4><a href="#">Experience the true taste of farm-fresh produce <br>
                                    <span class="d-flex justify-content-center"> delivered right to your home </span>
                                </a></h4>
                            {{-- <div class="price">
                                <h6>₹25.00</h6>
                                <del>₹30.00</del>
                            </div> --}}
                        </div>
                        <div class="offer-img d-lg-block d-none">
                            <img src="{{ asset('assets/images/bg/wheet_img.png') }}" height="120px" alt />
                        </div>
                        <a href={{ route('shop') }}>

                            <div class="offer-right d-flex">
                                <div class="offer-tag d-lg-none d-flex justify-content-center">
                                    {{-- <h3>50%<span>Off</span></h3> --}}
                                    Shop Now
                                </div>
                                {{-- <a class="primary-btn6" href="#">Shop Now</a> --}}
                                <div class="offer-tag d-lg-flex d-none">
                                    <h3>
                                        Shop<br />
                                        <span>Now</span>
                                    </h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mb-60">
                <div class="col-lg-12 d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="section-title3">
                        <!-- <h2><img src="{{ asset('assets/images/icon/h3-sec-tt-vect-left.svg') }}" alt /><span>Essential Items</span><img src="{{ asset('assets/images/icon/h3-sec-tt-vect-right.svg') }}" alt /></h2> -->
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="swiper essential-items-slider" wire:ignore>
                        <div class="swiper-wrapper">
                            @foreach ($fproducts as $fproduct)
                                <div class="swiper-slide">
                                    <div class="collection-card">
                                        <div class="offer-card">
                                            @if ($fproduct->discount_value != 0)
                                                <span>{{ $fproduct->discount_value }}% Off</span>
                                            @endif
                                        </div>
                                        <div class="collection-img">
                                            <a href="{{ route('product-details', ['slug' => $fproduct->slug]) }}"><img
                                                    class="img-gluid"
                                                    src="{{ asset('admin/product/feat') }}/{{ $fproduct->image }}"
                                                    alt height="136px" width="153px" /></a>
                                            <div class="view-dt-btn">
                                                <div class="plus-icon">
                                                    <i class="bi bi-plus"></i>
                                                </div>
                                                <a href="{{ route('product-details', ['slug' => $fproduct->slug]) }}">View
                                                    Details</a>
                                            </div>
                                            <ul class="cart-icon-list">
                                                <li>
                                                    @if (in_array($fproduct->id, $cartp))
                                                        <!--<a href="#"><img src="{{ asset('assets/images/icon/Icon-cart3.svg') }}" alt /></a>-->
                                                    @else
                                                        <a href="#"
                                                            wire:click.prevent="AddtoCart({{ $fproduct->id }},{{ $fproduct->bestSeller->price }},{{ $fproduct->bestSeller->vendor_id ?? '' }})"><img
                                                                src="{{ asset('assets/images/icon/Icon-cart3.svg') }}"
                                                                alt /></a>
                                                    @endif
                                                </li>
                                                <li>
                                                    @if (in_array($fproduct->id, $wishp))
                                                        <a href="#"
                                                            wire:click.prevent="removeFromWishlist({{ $fproduct->id }},{{ $fproduct->bestSeller->price }},{{ $fproduct->bestSeller->vendor_id ?? '' }})"><img
                                                                src="{{ asset('assets/images/icon/Icon-favorites3.svg') }}"
                                                                alt /></a>
                                                    @else
                                                        <a href="#"
                                                            wire:click.prevent="addToWishlist({{ $fproduct->id }},{{ $fproduct->bestSeller->price }},{{ $fproduct->bestSeller->vendor_id ?? '' }})"><img
                                                                src="{{ asset('assets/images/icon/Icon-favorites.svg') }}"
                                                                alt /></a>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="collection-content">
                                            <p class="fixed"><a
                                                    href="{{ route('product-details', ['slug' => $fproduct->slug]) }}">{{ $fproduct->name }}</a>
                                            </p>
                                            <div class="price priceds">
                                                <h6>₹{{ $fproduct->bestSeller->price }}</h6>
                                                <del>₹{{ $fproduct->regular_price }}</del>
                                            </div>
                                            <div class="review">
                                                @php
                                                    if (isset($fproduct->reviews)) {
                                                        $ratingAvg = $fproduct->reviews->avg('rating');
                                                        $ratingAv = $ratingAvg;
                                                        $ratingCount = $fproduct->reviews->count();
                                                    } else {
                                                        $ratingAvg = 0;
                                                        $ratingCount = 0;
                                                    }
                                                @endphp
                                                <ul>
                                                    @foreach (range(1, 5) as $i)
                                                        @if ($ratingAvg > 0)
                                                            @if ($ratingAvg > 0.5)
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                            @else
                                                                <li><i class="bi bi-star-half"></i></li>
                                                            @endif
                                                        @else
                                                            <li><i class="bi bi-star"></i></li>
                                                        @endif
                                                        @php $ratingAvg--; @endphp
                                                    @endforeach
                                                </ul>
                                                <span>{{ number_format($ratingAv, 2) }} ({{ $ratingCount }})</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="h1-service-area pt-40 mb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="section-title1 text-center">
                        <span> <img src="{{ asset('assets/images/icon/section-vec-l1.svg') }}"
                                alt="" />Services<img
                                src="{{ asset('assets/images/icon/section-vec-r1.svg') }}" alt="" /> </span>
                        <h2 class="word">Experience our services</h2>
                    </div>
                </div>
            </div>
            <div class="row d-sm-flex d-none">
                <div class="col-lg-12">
                    <div class="swiper-btn-wrap d-flex align-items-center justify-content-between">
                        <div class="slider-btn prev-btn-1" tabindex="0" role="button" aria-label="Previous slide"
                            aria-controls="swiper-wrapper-22aeeb9ea30fbea0">
                            <i class="bi bi-arrow-left"></i>
                        </div>
                        <div class="slider-btn next-btn-1" tabindex="0" role="button" aria-label="Next slide"
                            aria-controls="swiper-wrapper-22aeeb9ea30fbea0">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="swiper home1-services-slider swiper-initialized swiper-horizontal swiper-pointer-events">
                    <div class="swiper-wrapper" id="swiper-wrapper-5638a15701cf9d64" aria-live="off"
                        style="transform: translate3d(-1746px, 0px, 0px); transition-duration: 0ms;" wire:ignore>
                        <div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0" role="group"
                            aria-label="1 / 4" style="width: 267px; margin-right: 24px;">
                            <div class="services-card1">
                                <img class="services-card-vec mark-logo"
                                    src="{{ asset('/assets/images/icon/mark-logo.svg') }}" alt="" />
                                <div class="icon">
                                    <img src="{{ asset('assets/images/icon/daycare-center2.svg') }}"
                                        alt="" />
                                </div>
                                <div class="content">
                                    <h3><a href="#">Home Delivery </a></h3>
                                    <p>Grains, Millets, and Pulses straight to your porch, and you will make sure that
                                        quality, purity, and convenience will accompany you every time you get your
                                        order.</p>
                                </div>
                                {{-- <a class="more-btn" href="#">More Details<img
                                        src="{{ asset('assets/images/icon/btn-arrow1.svg') }}" alt="" /></a> --}}
                            </div>
                        </div>
                        <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-prev"
                            data-swiper-slide-index="1" role="group" aria-label="2 / 4"
                            style="width: 267px; margin-right: 24px;">
                            <div class="services-card1 two">
                                <img class="services-card-vec mark-logo"
                                    src="{{ asset('/assets/images/icon/mark-logo.svg') }}" alt="" />
                                <div class="icon">
                                    <img src="{{ asset('assets/images/icon/grooming2.svg') }}" alt="" />
                                </div>
                                <div class="content">
                                    <h3><a href="#">Straight from Farmers</a></h3>
                                    <p>Get your grains directly from farmers. Shop directly, know where you are getting
                                        them, and empower real humans to produce something that you need daily.</p>
                                </div>
                                {{-- <a class="more-btn" href="#">More Details<img
                                        src="{{ asset('assets/images/icon/btn-arrow1.svg') }}" alt="" /></a> --}}
                            </div>
                        </div>
                        <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active"
                            data-swiper-slide-index="2" role="group" aria-label="3 / 4"
                            style="width: 267px; margin-right: 24px;">
                            <div class="services-card1 three">
                                <img class="services-card-vec mark-logo"
                                    src="{{ asset('/assets/images/icon/mark-logo.svg') }}" alt="" />
                                <div class="icon">
                                    <img src="{{ asset('assets/images/icon/boarding2.svg') }}" alt="" />
                                </div>
                                <div class="content">
                                    <h3><a href="#"> Bulk Orders</a></h3>
                                    <p>Buy grains, pulses, and millets in bulk and use them in business, functions, or
                                        organizations - efficiently delivered with reasonable costs assured.</p>
                                </div>
                                {{-- <a class="more-btn" href="#">More Details<img
                                        src="{{ asset('assets/images/icon/btn-arrow1.svg') }}" alt="" /></a> --}}
                            </div>
                        </div>
                        {{-- <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="3" role="group" aria-label="4 / 4" style="width: 267px; margin-right: 24px;">
                            <div class="services-card1 four">
                                <img class="services-card-vec mark-logo" src="{{asset('/assets/images/bg/inner-Logo_bg.png')}}" alt="" />
                                <div class="icon">
                                    <img src="{{asset('assets/images/icon/veterinary2.svg')}}" alt="" />
                                </div>
                                <div class="content">
                                    <h3><a href="#">veterinary</a></h3>
                                    <p>Pellentesque maximus augue orciquista ut aliquet risus In hac habitasse.</p>
                                </div>
                                <a class="more-btn" href="#">More Details<img src="{{asset('assets/images/icon/btn-arrow1.svg')}}" alt="" /></a>
                            </div>
                        </div> --}}
                        <div class="swiper-slide" data-swiper-slide-index="0" role="group" aria-label="1 / 4"
                            style="width: 267px; margin-right: 24px;">
                            <div class="services-card1">
                                <img class="services-card-vec mark-logo"
                                    src="{{ asset('/assets/images/icon/mark-logo.svg') }}" alt="" />
                                <div class="icon">
                                    <img src="{{ asset('assets/images/icon/daycare-center2.svg') }}"
                                        alt="" />
                                </div>
                                <div class="content">
                                    <h3><a href="#">Customize your cart </a></h3>
                                    <p>Make it yourself, in your combination of grains and pulses to your specification
                                        - flexible volume, high quality, freshly packed with care.</p>
                                </div>
                                {{-- <a class="more-btn" href="#">More Details<img
                                        src="{{ asset('assets/images/icon/btn-arrow1.svg') }}" alt="" /></a> --}}
                            </div>
                        </div>
                        <div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="1" role="group"
                            aria-label="2 / 4" style="width: 267px; margin-right: 24px;">
                            <div class="services-card1 two">
                                <img class="services-card-vec mark-logo"
                                    src="{{ asset('/assets/images/icon/mark-logo.svg') }}" alt="" />
                                <div class="icon">
                                    <img src="{{ asset('assets/images/icon/grooming2.svg') }}" alt="" />
                                </div>
                                <div class="content">
                                    <h3><a href="#">Home Delivery </a></h3>
                                    <p>Grains, Millets, and Pulses straight to your porch, and you will make sure that
                                        quality, purity, and convenience will accompany you every time you get your
                                        order.

                                    </p>
                                </div>
                                {{-- <a class="more-btn" href="#">More Details<img
                                        src="{{ asset('assets/images/icon/btn-arrow1.svg') }}" alt="" /></a> --}}
                            </div>
                        </div>
                        <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="2" role="group"
                            aria-label="3 / 4" style="width: 267px; margin-right: 24px;">
                            <div class="services-card1 three">
                                <img class="services-card-vec mark-logo"
                                    src="{{ asset('/assets/images/icon/mark-logo.svg') }}" alt="" />
                                <div class="icon">
                                    <img src="{{ asset('assets/images/icon/boarding2.svg') }}" alt="" />
                                </div>
                                <div class="content">
                                    <h3><a href="#">Straight from Farmers</a></h3>
                                    <p>Get your grains directly from farmers. Shop directly, know where you are getting
                                        them, and empower real humans to produce something that you need daily.</p>
                                </div>
                                {{-- <a class="more-btn" href="#">More Details<img
                                        src="{{ asset('assets/images/icon/btn-arrow1.svg') }}" alt="" /></a> --}}
                            </div>
                        </div>
                        <!--<div class="swiper-slide swiper-slide-next" data-swiper-slide-index="3" role="group" aria-label="4 / 4" style="width: 267px; margin-right: 24px;">-->
                        <!--    <div class="services-card1 four">-->
                        <!--        <img class="services-card-vec" src="{{ asset('assets/images/bg/services-card-vec.png') }}" alt="" />-->
                        <!--        <div class="icon">-->
                        <!--            <img src="{{ asset('assets/images/icon/veterinary2.svg') }}" alt="" />-->
                        <!--        </div>-->
                        <!--        <div class="content">-->
                        <!--            <h3><a href="#">veterinary</a></h3>-->
                        <!--            <p>Pellentesque maximus augue orciquista ut aliquet risus In hac habitasse.</p>-->
                        <!--        </div>-->
                        <!--        <a class="more-btn" href="#">More Details<img src="{{ asset('assets/images/icon/btn-arrow1.svg') }}" alt="" /></a>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0" role="group"
                            aria-label="1 / 4" style="width: 267px; margin-right: 24px;">
                            <div class="services-card1">
                                <img class="services-card-vec mark-logo"
                                    src="{{ asset('/assets/images/icon/mark-logo.svg') }}" alt="" />
                                <div class="icon">
                                    <img src="{{ asset('assets/images/icon/daycare-center2.svg') }}"
                                        alt="" />
                                </div>
                                <div class="content">
                                    <h3><a href="#">Bulk Orders </a></h3>
                                    <p>Buy grains, pulses, and millets in bulk and use them in business, functions, or
                                        organizations - efficiently delivered with reasonable costs assured.
                                    </p>
                                </div>
                                {{-- <a class="more-btn" href="#">More Details<img
                                        src="{{ asset('assets/images/icon/btn-arrow1.svg') }}" alt="" /></a> --}}
                            </div>
                        </div>
                        <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-prev"
                            data-swiper-slide-index="1" role="group" aria-label="2 / 4"
                            style="width: 267px; margin-right: 24px;">
                            <div class="services-card1 two">
                                <img class="services-card-vec mark-logo"
                                    src="{{ asset('/assets/images/icon/mark-logo.svg') }}" alt="" />
                                <div class="icon">
                                    <img src="{{ asset('assets/images/icon/grooming2.svg') }}" alt="" />
                                </div>
                                <div class="content">
                                    <h3><a href="#">Customize your cart </a></h3>
                                    <p>Make it yourself, in your combination of grains and pulses to your specification
                                        flexible volume, high quality, freshly packed with care.
                                    </p>
                                </div>
                                {{-- <a class="more-btn" href="#">More Details<img
                                        src="{{ asset('assets/images/icon/btn-arrow1.svg') }}" alt="" /></a> --}}
                            </div>
                        </div>
                        <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active"
                            data-swiper-slide-index="2" role="group" aria-label="3 / 4"
                            style="width: 267px; margin-right: 24px;">
                            <div class="services-card1 three">
                                <img class="services-card-vec  mark-logo"
                                    src="{{ asset('/assets/images/icon/mark-logo.svg') }}" alt="" />
                                <div class="icon">
                                    <img src="{{ asset('assets/images/icon/boarding2.svg') }}" alt="" />
                                </div>
                                <div class="content">
                                    <h3><a href="#">Home Delivery</a></h3>
                                    <p>Grains, Millets, and Pulses straight to your porch, and you will make sure that
                                        quality, purity, and convenience will accompany you every time you get your
                                        order.</p>
                                </div>
                                {{-- <a class="more-btn" href="#">More Details<img
                                        src="{{ asset('assets/images/icon/btn-arrow1.svg') }}" alt="" /></a> --}}
                            </div>
                        </div>
                        <!--<div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="3" role="group" aria-label="4 / 4" style="width: 267px; margin-right: 24px;">-->
                        <!--    <div class="services-card1 four">-->
                        <!--        <img class="services-card-vec" src="{{ asset('assets/images/bg/services-card-vec.png') }}" alt="" />-->
                        <!--        <div class="icon">-->
                        <!--            <img src="{{ asset('assets/images/icon/veterinary2.svg') }}" alt="" />-->
                        <!--        </div>-->
                        <!--        <div class="content">-->
                        <!--            <h3><a href="#">veterinary</a></h3>-->
                        <!--            <p>Pellentesque maximus augue orciquista ut aliquet risus In hac habitasse.</p>-->
                        <!--        </div>-->
                        <!--        <a class="more-btn" href="#">More Details<img src="{{ asset('assets/images/icon/btn-arrow1.svg') }}" alt="" /></a>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="home3-testimonial-area mb-40">
        <div class="container">
            <div class="row mb-60">
                <div class="col-lg-12 d-flex align-items-center justify-content-between flex-wrap gap-3 utkrsh_title">
                    <div class="section-title3 align-items-center">
                        <h2><img class="kishan_left" src="{{ asset('assets/images/icon/utkarsh-kisan_bg.png') }}"
                                width="40" height="40" alt /><span class="word">Customers Think About
                                Us</span><img src="{{ asset('assets/images/icon/mark-logo.svg') }}" width="40"
                                height="40" alt /></h2>
                    </div>
                    <div class="slider-btn-wrap">
                        <div class="slider-btn prev-btn-12">
                            <i class="bi bi-arrow-left"></i>
                        </div>
                        <div class="slider-btn next-btn-12">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-11 mb-60">
                    <div class="swiper h3-testimonil-slider" wire:ignore>
                        <div class="swiper-wrapper">
                            @foreach ($testimonials as $testimonial)
                                <div class="swiper-slide">
                                    <div class="testimonial-wrapper">
                                        <div class="review">
                                            <ul>
                                                @for ($i = 1; $i <= $testimonial->star; $i++)
                                                    <li><i class="bi bi-star-fill"></i></li>
                                                @endfor
                                                @for ($i = 0; $i < 5 - $testimonial->star; $i++)
                                                    <li><i class="bi bi-star"></i></li>
                                                @endfor
                                            </ul>
                                        </div>
                                        <p>{{ $testimonial->description }}</p>
                                        <div class="author-area">
                                            <div class="author-img">
                                                <img src="{{ asset('admin/testimonial') }}/{{ $testimonial->image }}"
                                                    alt />
                                            </div>
                                            <div class="author-name-deg">
                                                <h3>{{ $testimonial->name }}</h3>
                                                {{-- <span>{{ $testimonial->position }}</span> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
