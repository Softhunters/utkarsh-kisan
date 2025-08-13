<div>
    @include('flash-message')
    <div class="inner-page-banner">
        <!-- <div class="breadcrumb-vec-btm">
            <img class="img-fluid" src="{{ asset('assets/images/bg/inner-banner-btm-vec.png') }}" alt />
        </div> -->
        <div class="container">
            <div class="row justify-content-center align-items-center text-center">
                <div class="col-sm-6 align-items-center banner-data">
                    <div class="banner-content">
                        <h1>Cart</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="banner-img d-block">
                        <!-- <div class="banner-img-bg">
                            <img class="img-fluid" src="{{ asset('assets/images/bg/inner-banner-vec.png') }}" alt />
                        </div> -->
                        <img class="img-fluid cart-banner-img"
                            src="{{ asset('assets/images/bg/inner-banner-img.png') }}" alt />
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Session::has('message'))
        <div class="alert alert-success">
            <strong>Alert</strong>{{ Session::get('message') }}
        </div>
    @endif
    <div class="cart-section pt-120 pb-120">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @if (isset($cart[0]))
                        <div class="coupon-area">
                            <div class="cart-coupon-input">
                                <h5 class="coupon-title">Cart</h5>

                            </div>
                        </div>
                        <div class="table-wrapper">
                            <table class="eg-table table cart-table">
                                <thead>
                                    <tr>

                                        <th>Image</th>
                                        <th>Seller Name</th>
                                        <th>Item Name</th>
                                        <th>Unit Price</th>
                                        <th>Sale Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                        <th>Delete</th>
                                        {{-- @auth
                                            <th>Action</th>
                                        @endauth --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $item)
                                        @php
                                            $i = $item->product ? $item->product : $item;
                                            $id = $item->product?->id ?? $item->id;
                                        @endphp
                                        <tr>
                                            <td data-label="Image">
                                                <img src="{{ asset('admin/product/feat') }}/{{ $i->image }}"
                                                    alt />
                                            </td>
                                            <td data-label="Seller Name"><a href="#">
                                                    {{ $item->vendor_name }}
                                                </a>
                                            </td>
                                            <td data-label="Item Name"><a
                                                    href="{{ route('product-details', ['slug' => $i->slug]) }}">
                                                    {{-- {{ $item->name }} --}}
                                                    {{ substr($i->name, 0, 20) }}

                                                </a>
                                            </td>
                                            <td data-label="Unite Price">
                                                <del>₹{{ $i->regular_price }}</del></td>
                                            <td data-label="Discount Price">₹{{ $item->vendor_price }}</td>
                                            <td data-label="Quantity">
                                                @if (Auth::check())
                                                    @if ($i->stock_status === 'instock')
                                                        <div
                                                            class="qty-input btn mt-4 mt-md-0 d-flex align-items-center  ">
                                                            <a class="btn btn-increase" href="#"
                                                                wire:click.prevent="decreaseQuantity('{{ $id }}')">-</a>
                                                            <input class="form-control me-0" type="text"
                                                                name="product-quatity" value="{{ $item->quantity }}"
                                                                data-max="5" pattern="[0-9]*"
                                                                style="width:100px !important">

                                                            {{-- @if ($item->quantity - $item->qty > 3) --}}
                                                            <a class="btn btn-increase" href="#"
                                                                wire:click.prevent="increaseQuantity('{{ $id }}')">+</a>
                                                            <input class="frm-input " value="1" type="hidden"
                                                                id ="outofqty" name="outofqty" wire:model="out_of_qty">
                                                            @php $this->out_of_qty = "" @endphp
                                                            {{-- @endif --}}
                                                        </div>
                                                    @else
                                                        <input class="frm-input" value="1" type="hidden"
                                                            name="outofsctock" wire:model="out_of_stock">
                                                        @php $this->out_of_stock = 2 @endphp
                                                        <p> Out of Stock</p>
                                                    @endif
                                                @else
                                                    @if ($i->stock_status === 'instock')
                                                        <!--<div class="nice-number">-->
                                                        <!--    <button type="button"><i class="bi bi-dash"></i></button>-->
                                                        <!--    <input type="number" value="1" min="1" data-nice-number-initialized="true" style="width: 2ch;">-->
                                                        <!--    <button type="button"><i class="bi bi-plus"></i></button>-->
                                                        <!--</div>-->


                                                        <div
                                                            class="qty-input btn mt-4 mt-md-0 d-flex align-items-center">
                                                            <a class="btn btn-increase" href="#"
                                                                wire:click.prevent="decreaseQuantity('{{ $id }}')">-</a>
                                                            <input type="text" class="form-control me-0"
                                                                name="product-quatity" value="{{ $item->quantity }}"
                                                                data-max="5" pattern="[0-9]*"
                                                                style="width:100px !important">
                                                            <a class="btn btn-increase" href="#"
                                                                wire:click.prevent="increaseQuantity('{{ $id }}')">+</a>
                                                        </div>
                                                    @else
                                                        <p> Out of Stock</p>
                                                    @endif
                                                @endif
                                            </td>
                                            <td data-label="Subtotal">
                                                ₹{{ number_format($item->vendor_price * $item->quantity, 2) }}</td>
                                            <td data-label="Delete">
                                                <div class="delete-icon">
                                                    <a href="#"
                                                        wire:click.prevent="removeFromCart({{ $id }})">
                                                        <i class="bi bi-x"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            {{-- @auth
                                                <td>
                                                    <div class="cart_product_remove">
                                                        <a href="#"
                                                            wire:click.prevent="Savetolater({{ $id }})">
                                                            <i class="ti-trash"></i> Save For Later</a>
                                                    </div>
                                                </td>
                                            @endauth --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-wishlist text-center mb-3">
                            <p style="text-align:center;">No Item Added In CART</p>
                            <a href="{{ route('shop') }}"><button
                                    class="btn btn-primary wishlist_shopping_btn">Continue
                                    Shopping</button></a>

                        </div>
                    @endif

                </div>
                @if (isset($cart[0]))
                    <div class="col-lg-4">
                        @if (Session::has('coupon_message'))
                            <div class="alert alert-success">
                                {{ Session::get('coupon_message') }}
                            </div>
                        @endif
                        <div class="coupon-area">
                            <div class="cart-coupon-input">

                                <form class="coupon-input d-flex align-items-center mb-1"
                                    wire:submit.prevent="applyCouponCode">
                                    <input type="text" name="coupon-code" class="form-control"
                                        wire:model="CouponCode" placeholder="Enter Coupon Code">

                                    @if ($discount)
                                        <button><a href ="#" wire:click.prevent="removeCoupon"
                                                style="color:white;">Remove Coupon</a></button>
                                    @else
                                        <button type="submit">Apply Code</button>
                                    @endif

                                </form>
                                @error('CouponCode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <table class="table total-table">
                            <thead>
                                <tr>
                                    <th>Cart Totals</th>
                                    <th></th>
                                    <th>₹{{ number_format($subtotalc + $pricesoff, 2) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Shipping</td>
                                    <td>
                                        <ul class="cost-list text-start">
                                            <li>Shipping Fee</li>
                                            <li>Off Discount</li>
                                            <!--<li>Total ( tax incl.)</li>-->
                                            @if ($discount)
                                                <li>Coupon Discount</li>
                                            @endif
                                            <!--<li>Taxes</li>-->
                                            <!--<li>-->
                                            <!--    Shipping Enter your address to view shipping options. <br />-->
                                            <!--    <a href="#">Calculate shipping</a>-->
                                            <!--</li>-->
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="single-cost text-center">
                                            <li>₹{{ number_format($shippingcost, 2) }}</li>
                                            <li>₹{{ number_format($pricesoff, 2) }}</li>
                                            <li></li>
                                            @if ($discount)
                                                <li>{{ number_format($discount, 2) }}</li>
                                            @endif
                                            <!--<li>$15</li>-->
                                            <!--<li>$15</li>-->
                                            <!--<li>$5</li>-->
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Subtotal</td>
                                    <td></td>
                                    <td>₹{{ number_format($subtotalc + $shippingcost - $discount, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="cart-btn-group">
                            <li><a href="{{ route('shop') }}" class="primary-btn2 btn-lg">Continue to shopping</a>
                            </li>
                            <li><a href="#" wire:click.prevent="checkout" class="primary-btn3 btn-lg">Proceed
                                    to Checkout</a></li>

                            @if (Session::has('cmessage'))
                                <div class="alert alert-success">
                                    <strong>Alert </strong>{!! Session::get('cmessage') !!}
                                </div>
                            @endif
                        </ul>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>




@push('scripts')
    <script>
        // $('#sbhjs').on('click',function(ev){
        //     //alert('gfhfgh');
        //     var data = $('#outofsctock').val();
        //     alert(data);
        //     @this.set('out_of_stock',data);
        // });

        // $('#sbhjs').on('click',function(ev){
        //     //alert('gfhfgh');
        //     var data = $('#outofqty').val();
        //     alert(data);
        //     @this.set('out_of_qty','1');
        // });

        window.addEventListener('show-edit-post-modal', event => {
            $('#login_modal').modal('show');
        });
    </script>
@endpush
