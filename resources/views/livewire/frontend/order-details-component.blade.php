<div>
  
    @section('page_css')
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/themify-icons@0.1.2/css/themify-icons.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/themify-icons@0.1.2/css/themify-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/themify-icons@0.1.2/css/themify-icons.css">

        <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endsection
    @include('flash-message')


    <main class="h1-story-area mb-120">
        <div class="accounnt_header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-auto col-6 order-md-2 order-2 col-md-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a class="text-nowrap" href="/"><i class="fa fa-home mr-2"></i>Home</a>
                                </li>

                                <li class="breadcrumb-item text-nowrap"><a href="account.html"><i
                                            class="fa fa-user mr-2"></i>Account</a>
                                </li>
                                <li class="breadcrumb-item text-nowrap active" aria-current="page">Order</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="order-md-1 text-center text-md-left col-lg col-6 order-1 col-md-6">
                        <h1 class="h3 mb-0 text-orange">Orders</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="accounnt_body">
            <div class="container mt-lg-0 mt-md-n9">
                <div class="row justify-content-between">
                    <div class="col-lg-4 col-md-4 col-12">
                        <nav class="navbar navbar-expand-md mb-5 mb-lg-0 sidenav">
                            <!-- Menu -->

                            <a class="d-xl-none d-lg-none d-md-none text-inherit fw-bold" href="#">Sidebar
                                Menu</a>
                            <!-- Button -->
                            {{-- <button class="navbar-toggler d-md-none rounded bg-primary text-light" type="button"
                                data-toggle="collapse" data-target="#sidenav" aria-controls="sidenav"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span><i class="fa-solid fa-bars"></i></span>
                            </button> --}}
                            <button class="navbar-toggler d-md-none bg-primary text-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#sidenav" aria-controls="sidenav"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span><i class="fa-solid fa-bars"></i></span>
                            </button>



                            <!-- Collapse navbar -->
                            <div class="collapse navbar-collapse" id="sidenav">

                                {{-- <div class="collapse navbar-collapse show" id="sidenav"> --}}
                                <div class="navbar-nav flex-column">
                                    <!-- List -->
                                    <div class="border-bottom">
                                        <div class="m-4">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="avater btn-soft-primary">
                                                        {{ substr(Auth::user()->name, 0, 1) }}</div>
                                                </div>
                                                <div class="col-auto">
                                                    <h6 class="d-block font-weight-bold mb-0">{{ Auth::user()->name }}
                                                    </h6>
                                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('user.account') }}"><i
                                                    class="bx bxs-user"></i> My
                                                Account <i class="fa-solid fa-chevron-right arrowo"></i></a></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('user.change-password') }}"><i
                                                    class="bx bxs-lock"></i>
                                                Password <i class="fa-solid fa-chevron-right arrowo"></i></a></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('user.address') }}"><i
                                                    class="bx bxs-book"></i>
                                                Address <i class="fa-solid fa-chevron-right arrowo"></i></a></a>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="nav-link" href="{{ route('orders') }}"><i class="bx bxs-cart"></i>
                                                Order <i class="fa-solid fa-chevron-right arrowo"></i></a></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('wishlist') }}"><i
                                                    class="bx bxs-heart"></i>
                                                Wishlist <i class="fa-solid fa-chevron-right arrowo"></i></a></a>
                                        </li>
                                        {{--  <li class="nav-item">
                                            <a class="nav-link" href="{{route('user.invite_earn')}}"><i class="bx bxs-heart"></i>
                                                Invite & Earn<i class="fa-solid fa-chevron-right arrowo"></i></a>
                                        </li>
                                        --}}
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out"></i>Logout</a>
                                        </li>
                                        <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                            @csrf
                                        </form>
                                    </ul>
                                </div>
                            </div>

                        </nav>
                    </div>
                    <div class="col-lg-8 col-md-8 col-12">
                        <div class="ml-0 ml-md-4 mt-md-n3">
                            <div class=" d-md-block">

                                <div class="row mb-md-5">
                                    <div class="col-lg-7  col-12 ">
                                        <h5 class="mb-1 text-orange">Order Details</h5>
                                        <p class="mb-0 text-orange small">
                                            You have full control to manage your own account setting.
                                        </p>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('orders') }}" class="btn btn-primary "> <i
                                                class="fa fa-angle-left"></i> Go Back</a>
                                        @if ($order->status == 'ordered')
                                            <a href="#" wire:click.prevent="cancelOrder"
                                                style="margin-left:20px" class="btn btn-warning pull-right">Cancel
                                                Order</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($orderitems as $orderitem)
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="cart_product border-0">
                                                    <div class="cart_item px-0 d-flex">
                                                        <div class="cart_item_image">
                                                            <img src="{{ asset('admin/product/feat') }}/{{ $orderitem->product->image }}"
                                                                alt="shop">
                                                        </div>
                                                        <div class="c-item-body">
                                                            <div class="cart_item_title mb-2">
                                                                <h4>{{ $orderitem->product->name }}</h4>
                                                                <p class="small mb-0 text-muted">
                                                                    {{ $orderitem->product->varaint_detail }}</p>
                                                            </div>
                                                            <div class="cart_item_price">
                                                                <div class="product-price">
                                                                    <span>
                                                                        <strong>₹{{ $orderitem->price }} </strong>
                                                                        <del>₹{{ $orderitem->product->regular_price }}</del>
                                                                        <small
                                                                            class="product-discountPercentage">({{ $orderitem->quantity }}
                                                                            items)</small>
                                                                    </span>
                                                                </div>
                                                                <div class="cart_product_remove">
                                                                    @if ($order->status == 'delivered')
                                                                        <a href="#"><i class="ti-truck"></i>
                                                                            Return Item</a>

                                                                        <a class="btn btn-rounded btn-primary"
                                                                            wire:click.prevent="preview({{ $orderitem->product->id }})"
                                                                            href="#">Post Review</a>
                                                                    @else
                                                                        @if ($orderitem->rstatus != 1)
                                                                            <a href="#" class=""
                                                                                style="color: var(--primary-color3);"
                                                                                wire:click.prevent="cancelOrderItem({{ $orderitem->id }})">
                                                                                {{-- <img src="{{ asset('img/logo/tras.png') }}"
                                                                                    alt=""
                                                                                    style="width:20px;"> --}}
                                                                                Cancel Item
                                                                            </a>
                                                                        @else
                                                                            <a href="#" class=""
                                                                                style="color: var(--primary-color3);">
                                                                                {{-- <img src="{{ asset('img/logo/tras.png') }}"
                                                                                    alt=""
                                                                                    style="width:20px;"> --}}
                                                                                Canceled
                                                                            </a>
                                                                        @endif
                                                                    @endif
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>


                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <div class="border p-3 mb-4">
                                                <h5 class="details">Order Info</h5>
                                                <div class="row no-gutters">
                                                    <div class="col-auto">

                                                        <i class="bx bxs-map orderDetailICon mr-2"></i>

                                                        <!-- <i class="ti-map-alt text-secondary mr-2"></i> -->
                                                    </div>
                                                    <div class="col">
                                                        <p class="text-muted small mb-2"> <strong>Delevery
                                                                Address:</strong> {{ $order->line1 }},
                                                            {{ $order->line2 }},{{ $order->zipcode }}</p>

                                                    </div>
                                                </div>
                                                <div class="row no-gutters">
                                                    <div class="col-auto">
                                                        <i class="bx bxs-phone orderDetailICon mr-2"></i>

                                                        <!-- <i class="ti-mobile text-secondary mr-2"></i> -->
                                                    </div>
                                                    <div class="col">
                                                        <p class="text-muted small mb-0"><strong>Phone Number:</strong>
                                                            {{ $order->mobile }}</p>
                                                    </div>
                                                </div>
                                                @if ($order->transaction)
                                                    <div class="row no-gutters">
                                                        <div class="col-auto">
                                                            <i class="bx bxs-credit-card orderDetailICon mr-2"></i>

                                                            <!-- <i class="ti-credit-card text-secondary mr-2"></i> -->
                                                        </div>

                                                        <div class="col">
                                                            <p class="text-muted small mb-2"><strong>Payment
                                                                    Type:</strong>
                                                                {{ $order->transaction->mode ?? '' }},{{ $order->transaction->status ?? '' }},{{ $order->transaction->transaction_id ?? '' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="row no-gutters">
                                                    <div class="col-auto">
                                                        <!-- <i class="ti-calendar text-secondary mr-2"></i> -->
                                                        <i class="bx bxs-calendar orderDetailICon mr-2"></i>
                                                    </div>
                                                    <div class="col">
                                                        <p class="text-muted small mb-2"><strong>Order Receive
                                                                On:</strong> {{ $order->created_at->format('d M Y') }}
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="timeline mt-4">
                                        <li class="timeline-item active">
                                            <div class="timeline-figure">

                                                <span class="tile tile-circle tile-sm">
                                                    <!-- <i class="ti-arrow-circle-down"></i> -->
                                                    <i class="bx bxs-box  "></i>

                                                </span>

                                            </div>
                                            <div class="timeline-body">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h6 class="timeline-heading">
                                                            Order placed
                                                        </h6>
                                                    </div>
                                                    <div class="d-none d-sm-block">

                                                        <span
                                                            class="timeline-date">{{ $order->created_at->format('d M Y') }}</span>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>


                                        <li class="timeline-item @if ($order->status == 'accepted') active @endif">
                                            <div class="timeline-figure">
                                                <span class="tile tile-circle tile-sm">
                                                    <!-- <i class="ti-arrow-circle-down"></i> -->
                                                    <i class="bx bxs-check-circle text-white"></i>

                                                </span>
                                            </div>
                                            <div class="timeline-body">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h6 class="timeline-heading">
                                                            <a href="#" class="text-link  ">Order Accepted</a>

                                                        </h6>
                                                    </div>
                                                    <div class="d-none d-sm-block">
                                                        <span class="timeline-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>


                                        @if ($order->status == 'delivered')
                                            <li class="timeline-item @if ($order->status == 'delivered') active @endif">
                                                <div class="timeline-figure">
                                                    <span class="tile tile-circle tile-sm"><i
                                                            class="ti-arrow-circle-down"></i></span>
                                                </div>
                                                <div class="timeline-body">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <h6 class="timeline-heading">
                                                                <a href="#" class="text-link">Order
                                                                    Delivered</a>
                                                            </h6>
                                                        </div>
                                                        <div class="d-none d-sm-block">
                                                            <span
                                                                class="timeline-date">{{ $order->delivered_date }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                        @if ($order->status == 'canceled')
                                            <li class="timeline-item @if ($order->status == 'canceled') active @endif">
                                                <div class="timeline-figure">
                                                    <span class="tile tile-circle tile-sm">
                                                        <i class="bx bxs-x-circle orderDetailICon text-white"></i>
                                                    </span>
                                                </div>
                                                <div class="timeline-body">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <h6 class="timeline-heading">
                                                                <a href="#" class="text-link">Order Canceled</a>
                                                            </h6>
                                                        </div>
                                                        <div class="d-none d-sm-block">
                                                            <span
                                                                class="timeline-date">{{ $order->canceled_date }}</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </li>
                                        @endif


                                    </ul>
                                </div><!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div wire:ignore.self class="modal fade" id="productPreviewModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <style>
            .rating {
                margin-top: 40px;
                border: none;
                float: left;
            }

            .rating>label {
                color: #90A0A3;
                float: right;
            }

            .rating>label:before {
                margin: 5px;
                font-size: 2em;
                font-family: FontAwesome;
                content: "\f005";
                display: inline-block;
            }

            .rating>input {
                display: none;
            }

            .rating>input:checked~label,
            .rating:not(:checked)>label:hover,
            .rating:not(:checked)>label:hover~label {
                color: #F79426;
            }

            .rating>input:checked+label:hover,
            .rating>input:checked~label:hover,
            .rating>label:hover~input:checked~label,
            .rating>input:checked~label:hover~label {
                color: #FECE31;
            }
        </style>
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title fs-5" id="staticBackdropLabel">Review Product</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                    @endif
                    <div class="mb-4">
                        <label for="form-banner/name" class="form-label">Product name: </label>
                        <input type="text" class="form-control" wire:model="pname" disabled />
                    </div>

                    <div class="mb-4">
                        <label for="form-banner/name" class="form-label">Message: </label>
                        <textarea type="text" class="form-control" wire:model="message" name='message'></textarea>
                        @error('message')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-lg-12">
                        <label class="infoTitle"> Image</label>
                        <div class="input-form input-form2">
                            <input type="file" placeholder="image" wire:model="images" multiple>
                            @if ($images)
                                @foreach ($images as $image)
                                    <img src="{{ $image->temporaryUrl() }}" width="120" />
                                @endforeach
                            @endif
                            @error('images')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="rating">
                        <input type="radio" id="star5" wire:model="rating" name="rating" value="5" />
                        <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                        <input type="radio" id="star4" wire:model="rating" name="rating" value="4" />
                        <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                        <input type="radio" id="star3" wire:model="rating" name="rating" value="3" />
                        <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                        <input type="radio" id="star2" wire:model="rating" name="rating" value="2" />
                        <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                        <input type="radio" id="star1" wire:model="rating" name="rating" value="1" />
                        <label class="star" for="star1" title="Bad" aria-hidden="true"></label>
                        @error('rating')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" wire:click.prevent="storeReview">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('openproductPreviewModal', (event) => {
                $('#productPreviewModal').modal('show');
            });
        });
    </script>
   
 @endpush
