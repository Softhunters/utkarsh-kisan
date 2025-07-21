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
                        <h1>Wishlist</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">WishList</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="banner-img d-block ">
                        <!-- <div class="banner-img-bg">
                            <img class="img-fluid" src="{{ asset('assets/images/bg/inner-banner-vec.png') }}" alt />
                        </div> -->
                        <img class="img-fluid wishlist-banner-img"  src="{{ asset('assets/images/bg/inner-banner-img.png') }}" alt />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cart-section pt-120 pb-120">
        <div class="container">
            @if (isset($wishlist[0]))
                <div class="row">
                    <div class="col-12">
                        <div class="table-wrapper">
                            <table class="eg-table table cart-table">
                                <thead>
                                    <tr>
                                        <th>Delete</th>
                                        <th>Image</th>
                                        <th>Item Name</th>
                                        <th>Seller Name</th>
                                        <th>Unit Price</th>
                                        <th>Discount Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wishlist as $item)
                                        <tr>
                                            <td data-label="Delete">
                                                <div class="delete-icon">
                                                    <a href="#"
                                                        wire:click.prevent="removeFromWishlist({{ $item->id }})">
                                                        <i class="bi bi-x"></i></a>
                                                </div>
                                            </td>
                                            <td data-label="Image">
                                                <img src="{{ asset('admin/product/feat') }}/{{ $item->image }}"
                                                    alt="" width="130px" height="160px" />
                                            </td>
                                            <td data-label="Food Name"><a
                                                    href="{{ route('product-details', ['slug' => $item->slug]) }}">
                                                    {{-- {{ $item->name }}  --}}
                                                      {{ substr($item->name, 0, 30) }}
                                                </a>
                                            </td>
                                           
                                            <td data-label="seller name" class="seller_data">{{ $item->seller_name??'' }}</td>
                                            <td data-label="Unite Price"><del>₹{{ $item->regular_price }}</del></td>
                                            <td data-label="Discount Price">₹{{ $item->sale_price }}</td>
                                            <td data-label="Quantity">
                                                <div class="quantity d-flex align-items-center">
                                                    <div class="quantity-nav nice-number d-flex align-items-center">
                                                        <input type="number" value="1" min="1" />
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-label="Subtotal">₹{{ $item->sale_price * $item->qty }}</td>
                                            <td><a href="#" wire:click.prevent="MoveTOCart({{ $item->id }})">
                                                    <i class="ti-trash"></i> Move to Cart</a></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row g-4">


                </div>
            @else
                <!--<p style="text-align:center;">No Item Added In Wishlist</p>-->
                <div class="empty-wishlist text-center">
                    <p style="text-align:center;">No Item Added In Wishlist</p>
                    <a href="{{ route('shop') }}"><button
                            class="btn btn-primary wishlist_shopping_btn">Continue
                            Shopping</button></a>

                </div>
            @endif
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
