<div>
    <style>
        #social-links ul {
            list-style: none;
            display: flex;
        }
    </style>
    @include('flash-message')
    <div class="inner-page-banner">
        <!-- <div class="breadcrumb-vec-btm">
            <img class="img-fluid" src="{{ asset('assets/images/bg/inner-banner-btm-vec.png') }}" alt />
        </div> -->
        <div class="container">
            <div class="row justify-content-center align-items-center text-center">
                <div class="col-sm-6 align-items-center banner-data">
                    <div class="banner-content">
                        <h1>Product Detail</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active d-flex flex-wrap" aria-current="page">
                                    {{-- {{ $product->name }}  --}}

                                    {{ substr($product->name, 0, 30) }}


                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="banner-img d-block">
                        <!-- <div class="banner-img-bg">
                            <img class="img-fluid" src="{{ asset('assets/images/bg/inner-banner-vec.png') }}" alt />
                        </div> -->
                        <img class="img-fluid product-banner-img"
                            src="{{ asset('assets/images/bg/inner-banner-img.png') }}" alt />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shop-details-page pt-120 mb-120">
        <div class="container">
            <div class="row g-lg-4 gy-5 mb-120">
                <div class="col-lg-6 col-md-5" wire:ignore>
                    <div class="tab-content tab-content1" id="v-pills-tabContent">
                        <div class="tab-pane fade active show" id="v-pills-img1" role="tabpanel"
                            aria-labelledby="v-pills-img1-tab">
                            <img class="img-fluid" src="{{ asset('admin/product/feat') }}/{{ $product->image }}"
                                alt="" style="height:400px; width:553px;" />
                        </div>

                        @php
                            $images = explode(',', $product->images);
                            $i = 2;
                        @endphp
                        @foreach ($images as $image)
                            @if ($image)
                                <div class="tab-pane fade" id="v-pills-img{{ $i }}" role="tabpanel"
                                    aria-labelledby="v-pills-img{{ $i }}-tab">
                                    <img class="img-fluid" src="{{ asset('admin/product') }}/{{ $image }}"
                                        alt="" style="height:400px; width:553px;" />
                                </div>
                                <?php $i++; ?>
                            @endif
                        @endforeach

                    </div>
                    <div class="nav nav1 nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-img1-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-img1" type="button" role="tab" aria-controls="v-pills-img1"
                            aria-selected="true">
                            <img src="{{ asset('admin/product/feat') }}/{{ $product->image }}" alt=""
                                height="99px" width="70px" />
                        </button>
                        @php

                            $i = 2;
                        @endphp
                        @foreach ($images as $image)
                            @if ($image)
                                <button class="nav-link" id="v-pills-img{{ $i }}-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-img{{ $i }}" type="button" role="tab"
                                    aria-controls="v-pills-img{{ $i }}" aria-selected="false">
                                    <img src="{{ asset('admin/product') }}/{{ $image }}" alt=""
                                        height="99px" width="70px" />
                                </button>
                                <?php $i++; ?>
                            @endif
                        @endforeach


                    </div>
                </div>
                <div class="col-lg-6 col-md-7">
                    <div class="shop-details-content">
                        <h3>{{ $product->name }}</h3>
                        <ul class="shopuct-review2 d-flex flex-row align-items-center mb-25">
                            @php
                                // $ratingAvg = $product->reviews->avg('rating');
                                $ratingAvg = 4;
                            @endphp
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
                            {{-- <li><a href="#" class="review-no">({{ $product->reviews->count() }})</a></li> --}}
                            <li><a href="#" class="review-no">(4)</a></li>
                        </ul>
                        <div class="model-number">
                            <span>SKU: {{ $product->SKU }}</span>
                            <span class="d-block text-muted mb-2"><strong>Availability : </strong>
                                @if ($product->stock_status == 'instock')
                                    In Stock
                                @else
                                    Out Of Stock
                                @endif
                            </span>
                        </div>
                        <div class="price-tag d-flex gap-3">
                            <h4>₹{{ $product->bestSeller->price }} <del>₹{{ $product->regular_price }}</del></h4>
                            <spna class="percent">({{ $product->discount_value }}% off)</spna>
                            <spna class="percent">Inclusive of all taxes</spna>
                        </div>
                        <!--<p>Donec bibendum enim ut elit porta ullamcorper. Vestibulum Nai wekemdini iaculis vitae nulla. Morbi mattis nec mi ac mollis.</p>-->
                        @if (isset($varaiants[1]))
                            <div class="varient mt-4 ">
                                <h6 class="font-weight-bold text-dark mb-3">Product Varient</h6>
                                <div class="row box-checkbox d-flex g-3 ">
                                    <!-- <label tabindex="0" class="wi">
                                        <input tabindex="-1" type="checkbox" checked name=""  wire:click.prevent="changeparameter({{ $product->id }})"/>
                                        <div class="icon-box">
                                            <div class="label">{{ $product->varaint_detail }}</div>
                                            <span class="value">₹{{ $product->sale_price }}</span>
                                        </div>
                                    </label> -->

                                    @foreach ($varaiants as $av)
                                        <a href = "#" class="wi"
                                            wire:click.prevent="changeparameter({{ $av->id }})">
                                            <label tabindex="0">
                                                <input tabindex="-1" type="checkbox"
                                                    @if ($av->id == $product->id) checked @endif name="" />
                                                <div class="icon-box">
                                                    <div class="label">{{ $av->variant_detail }}</div>
                                                    <span class="value">₹{{ $av->bestSeller->price ?? 'N/A' }}</span>
                                                </div>
                                            </label>
                                        </a>
                                    @endforeach

                                </div>
                            </div>
                        @endif
                        <div class="shop-quantity d-flex align-items-center justify-content-start mb-20">
                            <div class="quantity d-flex align-items-center">
                                <div class="quantity-nav nice-number d-flex align-items-center" wire:ignore>
                                    <input type="number" value="1" min="1" name="quntiti"
                                        id= "quntiti" wire:model="quntiti" />
                                </div>
                            </div>
                            @if (in_array($product->id, $cartp))
                                <a href="{{ route('cart') }}" class="primary-btn3">Already In Cart</a>
                            @else
                                <a href="#"
                                    wire:click.prevent="AddtoCart({{ $product->id }},{{ $product->bestSeller->price }},{{ $product->bestSeller->vendor_id ?? '' }})"
                                    class="primary-btn3">Add to cart</a>
                            @endif

                        </div>
                        @auth
                            <div class="buy-now-btn">
                                <a wire:click.prevent="checkout({{ $product->id }},{{ $product->bestSeller->price }})">Buy
                                    Now</a>
                            </div>
                        @endauth
                        @if ($otherVendors->count() > 1)
                            <div class="buy-now-btn mt-3">
                                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                                    data-bs-target="#vendorModal">
                                    Other Sellers Information
                                </button>
                            </div>
                        @endif
                        <div class="compare-wishlist-area d-lg-flex wishs">
                            <ul>
                                <!--<li>-->
                                <!--    <a href="#">-->
                                <!--        <span><img src="{{ asset('assets/images/icon/compare.svg') }}" alt /></span> Compare-->
                                <!--    </a>-->
                                <!--</li>-->
                                <li>
                                    @if (in_array($product->id, $wishp))
                                        <a href="#"
                                            wire:click.prevent="removeFromWishlist({{ $product->id }},{{ $fproduct->bestSeller->vendor_id ?? '' }})">
                                            <span>
                                                <svg width="14" height="13" viewBox="0 0 14 13"
                                                    xmlns="http://www.w3.org/2000/svg" fill="#699a39">
                                                    <path
                                                        d="M12.4147 1.51371C11.0037 0.302997 8.92573 0.534835 7.61736 1.87434L7.12993 2.38954L6.61684 1.87434C5.33413 0.534835 3.23047 0.302997 1.81948 1.51371C0.203258 2.90473 0.126295 5.37767 1.56294 6.87174L6.53988 12.0237C6.84773 12.3586 7.38647 12.3586 7.69433 12.0237L12.6713 6.87174C14.1079 5.37767 14.0309 2.90473 12.4147 1.51371Z" />

                                                </svg>
                                            </span> Remove form wishlist
                                        </a>
                                    @else
                                        <a href="#"
                                            wire:click.prevent="addToWishlist({{ $product->id }},{{ $product->bestSeller->price }})">
                                            <span><img src="{{ asset('assets/images/icon/Icon-favorites2.svg') }}"
                                                    alt /></span> Add to wishlist
                                        </a>
                                    @endif

                                </li>
                            </ul>
                            <div class="mt-lg-2  mt-md-4 mt-4 d-flex gap-4">
                                <h6 class="font-weight-bold text-dark"style="font-weight: 600;">Share on</h6>
                                <div class="social-links social-links-dark">

                                    {!! $shareButtons !!}

                                </div>
                            </div>
                        </div>
                        <div class="pyment-method">
                            <h6>Guaranted Safe Checkout</h6>
                            <ul>
                                <li><img src="{{ asset('assets/images/icon/visa2.svg') }}" alt /></li>
                                <li><img src="{{ asset('assets/images/icon/amex.svg') }}" alt /></li>
                                <li><img src="{{ asset('assets/images/icon/discover.svg') }}" alt /></li>
                                <li><img src="{{ asset('assets/images/icon/mastercard.svg') }}" alt /></li>
                                <li><img src="{{ asset('assets/images/icon/stripe.svg') }}" alt /></li>
                                <li><img src="{{ asset('assets/images/icon/paypal.svg') }}" alt /></li>
                                <li><img src="{{ asset('assets/images/icon/pay.svg') }}" alt /></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="row mb-70">
                    <div class="col-lg-12">
                        <div class="tab-box"> 
                            <div class="nav nav2 nav nav-pills" id="v-pills-tab2" role="tablist"
                                aria-orientation="vertical" >
                                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-home" type="button" role="tab"
                                    aria-controls="v-pills-home" aria-selected="false">Description</button>
                                @if ($product->short_description)
                                    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-profile" type="button" role="tab"
                                        aria-controls="v-pills-profile" aria-selected="true">Additional Info</button>
                                @endif
                                @if ($product->manufacturer_details)
                                    <button class="nav-link" id="v-pills-manufact-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-manufact" type="button" role="tab"
                                        aria-controls="v-pills-manufact" aria-selected="true">Manufacturer Info</button>
                                @endif
                                <button class="nav-link" id="v-pills-common-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-common" type="button" role="tab"
                                    aria-controls="v-pills-common" aria-selected="true">Review</button>
                                <!-- <button class="nav-link" id="v-pills-qa-tab" data-bs-toggle="pill" data-bs-target="#v-pills-qa" type="button" role="tab" aria-controls="v-pills-qa" aria-selected="true">Q & A</button> -->
                            </div>
                        </div>
                        <div class="tab-content tab-content2" id="v-pills-tabContent2">
                            <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="description styled-table">
                                    <p>{!! $product->description !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <div class="addithonal-information styled-table ">
                                    <p>{!! $product->short_description !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-manufact" role="tabpanel"
                                aria-labelledby="v-pills-manufact-tab">
                                <div class="addithonal-information styled-table">
                                    <p>{!! $product->manufacturer_details !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-common" role="tabpanel"
                                aria-labelledby="v-pills-common-tab">
                                <div class="reviews-area">
                                    <div class="row g-lg-4 gy-5">
                                        <div class="col-lg-8">
                                            <div class="number-of-review">
                                                {{-- <h3>Review ({{ $product->reviews->count() }}) :</h3> --}}
                                                <h3>Review (4) :</h3>
                                                @php
                                                    // $ratingAvg = $product->reviews->avg('rating');
                                                    $ratingAvg = 4;
                                                @endphp
                                                @foreach (range(1, 5) as $i)
                                                    @if ($ratingAvg > 0)
                                                        @if ($ratingAvg > 0.5)
                                                            <i class="bi bi-star-fill"></i>
                                                        @else
                                                            <i class="bi bi-star-half"></i>
                                                        @endif
                                                    @else
                                                        <i class="bi bi-star"></i>
                                                    @endif
                                                    @php $ratingAvg--; @endphp
                                                @endforeach
                                            </div>
                                            <div class="review-list-area">
                                                <ul class="review-list">
                                                    {{-- @forelse($product->reviews as $review)
                                                        <li>
                                                            <div
                                                                class="single-review  justify-content-between flex-md-nowrap flex-wrap">

                                                                <div class="review-content" style="width:50%;">
                                                                    <div class="c-header d-flex align-items-center">
                                                                        <div class="review-meta">
                                                                            <h5 class="mb-0"><a
                                                                                    href="#">{{ $review->user->name }}
                                                                                    ,</a></h5>
                                                                            <div class="c-date">06 july,2022</div>
                                                                        </div>
                                                                        <div class="replay-btn">
                                                                            <a href="#"><i
                                                                                    class="bi bi-reply"></i>Reply</a>
                                                                        </div>
                                                                    </div>

                                                                    <ul class="product-review">
                                                                        @foreach (range(1, 5) as $i)
                                                                            @if ($review->rating > 0)
                                                                                @if ($review->rating > 0.5)
                                                                                    <li><i class="bi bi-star-fill"></i>
                                                                                    </li>
                                                                                @else
                                                                                    <li><i class="bi bi-star-half"></i>
                                                                                    </li>
                                                                                @endif
                                                                            @else
                                                                                <li><i class="bi bi-star"></i></li>
                                                                            @endif
                                                                            @php $review->rating--; @endphp
                                                                        @endforeach
                                                                    </ul>
                                                                    <div class="c-body">
                                                                        <p>{{ $review->message }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="review-image"
                                                                    style="width:50%; display:flex; gap:10px;">
                                                                    @php
                                                                        $images = explode(',', $review->images);
                                                                    @endphp
                                                                    @foreach ($images as $image)
                                                                        @if ($image)
                                                                            <img data-enlargable
                                                                                src="{{ asset('admin/review') }}/{{ $image }}"
                                                                                style="height:90px; width:100%;"
                                                                                alt="slider">
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @empty
                                                        <p>No Review Posted Yet!</p>
                                                        @endforelse --}}
                                                    <p>No Review Posted Yet!</p>
                                                </ul>
                                            </div>
                                        </div>
                                        @if ($reviewyes)
                                            <div class="col-lg-4">
                                                <div class="review-form">
                                                    <div class="number-of-review">
                                                        <h3>Leave A Review</h3>
                                                    </div>
                                                    @if (Session::has('message'))
                                                        <div class="alert alert-success" role="alert">
                                                            {{ Session::get('message') }}</div>
                                                    @endif
                                                    <form wire:submit.prevent="storeReview({{ $product->id }})">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <label for="form-review/message" class="form-label">
                                                                    Image</label>
                                                                <div class="form-inner mb-20">
                                                                    <input type="file" placeholder="image"
                                                                        wire:model="rimages" multiple>
                                                                    @if ($rimages)
                                                                        @foreach ($rimages as $image)
                                                                            <img src="{{ $image->temporaryUrl() }}"
                                                                                width="120" />
                                                                        @endforeach
                                                                    @endif
                                                                    @error('rimages')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <div class="form-inner mb-10">
                                                                    <textarea wire:model="message" placeholder="Message..."></textarea>
                                                                    @error('message')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-inner2 mb-30">
                                                                    <div class="review-rate-area">
                                                                        <p>Your Rating</p>
                                                                        <div class="rate">
                                                                            <input type="radio" id="star5"
                                                                                wire:model="rate" name="rate"
                                                                                value="5" />
                                                                            <label for="star5" title="text">5
                                                                                stars</label>
                                                                            <input type="radio" id="star4"
                                                                                wire:model="rate" name="rate"
                                                                                value="4" />
                                                                            <label for="star4" title="very good">4
                                                                                stars</label>
                                                                            <input type="radio" id="star3"
                                                                                wire:model="rate" name="rate"
                                                                                value="3" />
                                                                            <label for="star3" title="good">3
                                                                                stars</label>
                                                                            <input type="radio" id="star2"
                                                                                wire:model="rate" name="rate"
                                                                                value="2" />
                                                                            <label for="star2" title="nice">2
                                                                                stars</label>
                                                                            <input type="radio" id="star1"
                                                                                wire:model="rate" name="rate"
                                                                                value="1" />
                                                                            <label for="star1" title="bad">1
                                                                                star</label>
                                                                        </div>
                                                                    </div>
                                                                    @error('rate')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-inner two">
                                                                    <button class="primary-btn3 btn-lg"
                                                                        type="submit">Post Review</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-qa" role="tabpanel"
                                aria-labelledby="v-pills-qa-tab">
                                <div class="reviews-area">
                                    <div class="row g-lg-4 gy-5">
                                        <div class="col-lg-8">
                                            <div class="number-of-review">
                                                <h3>Questions :</h3>
                                            </div>
                                            <div class="review-list-area">
                                                <ul class="review-list">
                                                    {{-- @foreach ($product->questions as $question)
                                                        <li>
                                                            <div
                                                                class="single-review d-flex justify-content-between flex-md-nowrap flex-wrap">

                                                                <div class="review-content">
                                                                    <div class="c-header d-flex align-items-center">
                                                                        <div class="review-meta">
                                                                            <h5 class="mb-0"><a
                                                                                    href="#">{{ $question->question }}
                                                                                    ,</a></h5>
                                                                            <div class="c-date">
                                                                                {{ $question->user->name }} </div>
                                                                        </div>
                                                                        <div class="replay-btn">
                                                                            <a href="#"><i
                                                                                    class="bi bi-reply"></i>Reply</a>
                                                                        </div>
                                                                    </div>


                                                                    <div class="c-body">
                                                                        @foreach ($question->answers as $answer)
                                                                            <p>{{ $answer->answer }},{{ $answer->user->name }}
                                                                            </p>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach --}}
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="review-form">
                                                <div class="number-of-review">
                                                    <h3>Ask Question</h3>
                                                </div>
                                                @if (Session::has('message'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ Session::get('message') }}</div>
                                                @endif
                                                <form wire:submit.prevent="storeQuestion({{ $product->id }})">

                                                    <div class="col-lg-12">
                                                        <div class="form-inner mb-10">
                                                            <textarea wire:model="question" placeholder="Question"></textarea>
                                                            @error('question')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-inner two">
                                                            <button class="primary-btn3 btn-lg" type="submit">Post
                                                                Question</button>
                                                        </div>
                                                    </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div
                    class="col-lg-12 d-flex flex-wrap align-items-center justify-content-md-between justify-content-start gap-2 mb-60">
                    <div class="inner-section-title">
                        <h2>Other Products</h2>
                    </div>
                    <div class="swiper-btn-wrap d-flex align-items-center">
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
            <div class="row">
                <div class="swiper essential-items-slider">
                    <div class="swiper-wrapper">
                        @foreach ($related_products as $fproduct)
                            <div class="col-lg-3 col-md-3 col-6">
                                <div class="collection-card">
                                    <div class="offer-card">
                                        <span>{{ $fproduct->discount_value }}% Off</span>
                                    </div>
                                    @if ($fproduct->stock_status == 'outofstock')
                                        <span class=" bg-white rounded-sm inline-block text-center solded">Sold
                                            Out</span>
                                    @endif
                                    <div class="collection-img @if ($fproduct->stock_status == 'outofstock') blured @endif">
                                        <a
                                            href="{{ route('product-details', ['slug' => $fproduct->slug]) }}"><img
                                                class="img-gluid"
                                                src="{{ asset('admin/product/feat') }}/{{ $fproduct->image }}"
                                                alt="" height="136px" width="153px" /> </a>
                                        {{-- <a href="#"><img class="img-gluid" src="{{asset('admin/product/feat')}}/{{$product->image}}" alt="" height="136px" width="153px" /> </a> --}}
                                        <div class="view-dt-btn">
                                            <div class="plus-icon">
                                                <i class="bi bi-plus"></i>
                                            </div>
                                            <a
                                                href="{{ route('product-details', ['slug' => $fproduct->slug]) }}">View
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
                                                        wire:click.prevent="addToWishlist({{ $fproduct->id }},{{ $fproduct->bestSeller->price }})"><img
                                                            src="{{ asset('assets/images/icon/Icon-favorites.svg') }}"
                                                            alt /></a>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="collection-content text-center">
                                        <p class="fixed">
                                            <a
                                                href="{{ route('product-details', ['slug' => $fproduct->slug]) }}">{{ $fproduct->name }}</a>
                                            {{-- <a href="#">{{$product->name}}</a> --}}
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


                                            {{-- <span>{{number_format($ratingAv,2)}}  ({{$ratingCount}})</span> --}}
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
    <!-- Vendor Details Modal -->
    <div class="modal fade" id="vendorModal" tabindex="-1" aria-labelledby="vendorModalLabel" aria-hidden="true"
        wire:ignore>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vendorModalLabel">Available Sellers for "{{ $product->name }}"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @if ($otherVendors->count())
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle vendor_table">
                                <thead class="table-light">
                                    <tr>
                                        <th  >Vendor Name</th>
                                        <th  >Price</th>
                                        <th  >Quantity</th>
                                        <th  >Action</th>
                                        <th  >Additional Info</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($otherVendors as $vp)
                                        <tr>
                                            <td><a
                                                    href="{{ route('vendorProduct', ['slug' => $vp->vendor_id]) }}">{{ $vp->vendor->name ?? 'N/A' }}</a>
                                            </td>
                                            <td>₹{{ number_format($vp->price) }}</td>
                                            <td>{{ $vp->quantity }}</td>
                                            <td><a href="#"
                                                    wire:click.prevent="AddtoCart({{ $vp->product_id }},{{ $vp->price }},{{ $vp->vendor_id ?? '' }})"
                                                    class="primary-btn3 add_cartBtn">Add to cart</a></td>
                                            <td>{!! $vp->additional_info !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No other vendors available for this product currently.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>


</div>
</div>

@push('scripts')
    <script src="{{ asset('assets/js/jquery.nice-number.min.js') }}"></script>

    <script>
        var incremented = 1,
            decremented = 1;
        $('#quntiti').niceNumber({
            autoSizeBuffer: 2,
            onIncrement: function($currentInput, amount) {
                //  alert(amount);
                @this.set('quntiti', amount);

            },
            onDecrement: function($currentInput, amount) {
                @this.set('quntiti', amount);
            },
        });
    </script>
    <script>
        $('img[data-enlargable]').addClass('img-enlargable').click(function() {
            var src = $(this).attr('src');
            $('<div>').css({
                background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
                backgroundSize: 'contain',
                width: '100%',
                height: '100%',
                position: 'fixed',
                zIndex: '10000',
                top: '0',
                left: '0',
                // cursor: 'zoom-out'
            }).click(function() {
                $(this).remove();
            }).appendTo('body');
        });
    </script>
@endpush
