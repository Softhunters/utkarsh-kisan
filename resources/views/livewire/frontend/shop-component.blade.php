<div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @include('flash-message')
    <div class="inner-page-banner">
        {{-- <div class="breadcrumb-vec-btm">
            <img class="img-fluid" src="assets/images/bg/inner-banner-btm-vec.png" alt />
        </div> --}}
        <div class="container">
            <div class="row justify-content-center align-items-center text-center">
                <div class="col-sm-6 align-items-center banner-data">
                    <div class="banner-content  ">
                        <h1>Shop</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Shop</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="banner-img d-block  ">
                        {{-- <div class="banner-img-bg">
                            <img class="img-fluid" src="{{asset('assets/images/bg/inner-banner-vec.png')}}" alt />
                        </div> --}}
                        <img class="img-fluid shop-banner-img"
                            src="{{ asset('assets/images/bg/inner-banner-img.png') }}" alt />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shop-page pt-40 mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 d-lg-block d-md-none d-none  ">
                    <div class="shop-sidebar">
                        <div class="shop-widget">
                            <h5 class="shop-widget-title">Price Range</h5>
                            <div class="range-widget" wire:ignore>
                                <div id="slider-range" class="price-filter-range"></div>
                                <div class="mt-25 d-flex justify-content-between gap-5">

                                    <input type="number" min="10" max="{{ $max - 1 }}"
                                        oninput="validity.valid||(value='10');" id="min_price"
                                        class="price-range-field rans  nice_num1" />
                                    <input type="number" min="10" max="{{ $max }}"
                                        oninput="validity.valid||(value={{ $max }});" id="max_price"
                                        class="price-range-field rans  nice_num2" />
                                </div>
                            </div>
                        </div>
                        <div class="shop-widget">
                            <div class="check-box-item">
                                <h5 class="shop-widget-title">Category</h5>
                                <div class="checkbox-container">
                                    @foreach ($categorys as $category)
                                        <a href="{{ route('product.category', ['category_slug' => $category->slug]) }}"><label
                                                class="containerss">
                                                {{ $category->name }}


                                            </label></a>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="shop-widget">
                            <div class="check-box-item">
                                <h5 class="shop-widget-title">Brand</h5>
                                <div class="checkbox-container">
                                    @foreach ($brands as $brand)
                                        <label class="containerss">
                                            {{ $brand->brand_name }}
                                            <input type="checkbox" wire:model="brandtype" value="{{ $brand->id }}"
                                                wire:click="brandseletc" />
                                            <span class="checkmark"></span>
                                        </label>
                                    @endforeach

                                </div>
                            </div>
                        </div>


                    </div>
                </div>


                <div class="col-lg-9 col-md-12 col-12">
                    @include('livewire.mobile-sidebar-component')
                    <div class="row mb-50">
                        <div class="col-lg-12 d-lg-block d-md-none d-none">
                            <div class="multiselect-bar">

                                <h6>shop</h6>
                                <div class="multiselect-area noneds" wire:ignore>
                                    <div class="single-select ">
                                        <span>Show</span>
                                        <select class="defult-select-drowpown " id="pagewsize" name="pagewsize"
                                            wire:model="pagesize">
                                            <option selected value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="30">30</option>
                                            <option value="40">40</option>
                                        </select>
                                    </div>
                                    <div class="single-select two ">
                                        <select class="defult-select-drowpown " id="pagesorting" name ="pagesorting"
                                            wire:model="sorting">
                                            <option selected value ="default">Default</option>
                                            <option value="date">Sort by newness</option>
                                            <option value="price">Sort by price: low to high</option>
                                            <option value="price-desc">Sort by price: high to low</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 justify-content-center">
                        @forelse($products as $product)
                            <div class="col-lg-3 col-md-3 col-6">
                                <div class="collection-card">
                                    <div class="offer-card">
                                        @if ($product->discount_value != 0)
                                            <span>{{ $product->discount_value }}% Off</span>
                                        @endif
                                    </div>
                                    @if ($product->stock_status == 'outofstock')
                                        <span class=" bg-white rounded-sm inline-block text-center solded">Sold
                                            Out</span>
                                    @endif
                                    <div class="collection-img @if ($product->stock_status == 'outofstock') blured @endif">
                                        <a href="{{ route('product-details', ['slug' => $product->slug]) }}"><img
                                                class="img-gluid"
                                                src="{{ asset('admin/product/feat') }}/{{ $product->image }}"
                                                alt="" width="130px" height="160px" /></a>
                                        {{-- <a href="#"><img class="img-gluid" src="{{asset('admin/product/feat')}}/{{$product->image}}" alt="" width="130px" height="160px" /></a> --}}
                                        <div class="view-dt-btn">
                                            <div class="plus-icon">
                                                <i class="bi bi-plus"></i>
                                            </div>
                                            <a href="{{ route('product-details', ['slug' => $product->slug]) }}">View
                                                Details</a>
                                            {{-- <a href="#">View Details</a> --}}
                                        </div>
                                        @if ($product->stock_status != 'outofstock')
                                            <ul class="cart-icon-list">
                                                <li>
                                                    @if (in_array($product->id, $cartp))
                                                        <!--<a href="#"><img src="{{ asset('assets/images/icon/Icon-cart3.svg') }}" alt /></a>-->
                                                    @else
                                                        <a href="#"
                                                            wire:click.prevent="AddtoCart({{ $product->id }},{{ $product->bestSeller->price }},{{ $product->bestSeller->vendor_id ?? '' }})"><img
                                                                src="{{ asset('assets/images/icon/Icon-cart3.svg') }}"
                                                                alt /></a>
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
                                        @endif
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


                                            {{-- <span>{{number_format(($ratingAv),2)}}  ({{$ratingCount}})</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">No Product Found</p>
                        @endforelse

                    </div>
                    <div class="row pt-70">
                        <div class="col-lg-12 d-flex justify-content-center">
                            <div class="paginations-area">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        {{ $products->links('vendor/livewire/bootstrap') }}
                                        <!--<li class="page-item">-->
                                        <!--    <a class="page-link" href="#"><i class="bi bi-arrow-left-short"></i></a>-->
                                        <!--</li>-->
                                        <!--<li class="page-item active"><a class="page-link" href="#">01</a></li>-->
                                        <!--<li class="page-item"><a class="page-link" href="#">02</a></li>-->
                                        <!--<li class="page-item"><a class="page-link" href="#">03</a></li>-->
                                        <!--<li class="page-item">-->
                                        <!--    <a class="page-link" href="#"><i class="bi bi-arrow-right-short"></i></a>-->
                                        <!--</li>-->
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script src="{{ asset('assets/js/jquery.nice-number.min.js') }}"></script>
    <script>
        if ($('input[type="number').length) {
            $('input[type="number"]').niceNumber({
                buttonDecrement: '<i class="bi bi-dash"></i>',
                buttonIncrement: '<i class="bi bi-plus"></i>'
            });
        }
    </script>
    <script>
        $(function() {
            $("#slider-range").slider({
                range: true,
                orientation: "horizontal",
                min: 10,
                max: <?php echo $max; ?>,
                values: [0, <?php echo $max / 2; ?>],
                step: 10,
                slide: function(event, ui) {
                    if (ui.values[0] == ui.values[1]) {
                        return false;
                    }
                    $("#min_price").val(ui.values[0]);
                    $("#max_price").val(ui.values[1]);
                },
            });
            $("#min_price").val($("#slider-range").slider("values", 0));
            $("#max_price").val($("#slider-range").slider("values", 1));
        });

        $("#min_price,#max_price").on("change", function() {
            // $("#price-range-submit").show();
            var min_price_range = $("#min_price").val();
            var max_price_range = $("#max_price").val();
            if (min_price_range > max_price_range) {
                $("#max_price").val(min_price_range);
            }
            // alert(min_price_range);
            @this.set('min_price', min_price_range);
            @this.set('max_price', max_price_range);
            $("#slider-range").slider({
                values: [min_price_range, max_price_range]
            });
            // alert(min_price_range);

        });
        $("#min_price,#max_price").on("paste keyup", function() {
            $("#price-range-submit").show();
            var min_price_range = $("#min_price").val();
            var max_price_range = $("#max_price").val();
            if (min_price_range == max_price_range) {
                max_price_range = min_price_range + 10;
                $("#min_price").val(min_price_range);
                $("#max_price").val(max_price_range);
            }
            @this.set('min_price', min_price_range);
            @this.set('max_price', max_price_range);
            $("#slider-range").slider({
                values: [min_price_range, max_price_range]
            });
        });
        $("#slider-range").on("click", function() {
            var min_price = $("#min_price").val();
            var max_price = $("#max_price").val();

            @this.set('min_price', min_price);
            @this.set('max_price', max_price);

            // $("#searchResults").text("Here List of products will be shown which are cost between " + min_price + " " + "and" + " " + max_price + ".");
        });
    </script>

    <script>
        $(document).on('click.nice_select', '.nice-select .option:not(.disabled)', function(event) {

            var $option = $(this);
            var $dropdown = $option.closest('.nice-select');

            $dropdown.find('.selected').removeClass('selected');
            $option.addClass('selected');

            var text = $option.data('display') || $option.text();
            $dropdown.find('.current').text(text);
            //   alert($option.data('value'));
            if (isNaN($option.data('value'))) {

                var data = $option.data('value');
                //alert(data);
                @this.set('sorting', data);
            } else {
                var data = $option.data('value');
                //alert(data);
                @this.set('pagesize', data);
            }
            $dropdown.prev('select').val($option.data('value')).trigger('change');
        });
    </script>
@endpush
