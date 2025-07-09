<div>
    @section('page_css')
    <link href="{{asset('assets/css/theme.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                                        <a class="text-nowrap" href="index.html"><i class="fa fa-home mr-2"></i>Home</a>
                                    </li>
                                    <li class="breadcrumb-item text-nowrap"><a href="account.html"><i class="fa fa-user mr-2"></i>Account</a>
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
                <div class="container mt-md-n9">
                    <div class="row justify-content-between">
                        <div class="col-lg-4 col-md-5 col-12">
                            <nav class="navbar navbar-expand-md mb-4 mb-lg-0 sidenav">
                                <!-- Menu -->
                                <a class="d-xl-none d-lg-none d-md-none text-inherit fw-bold" href="#">Sidebar Menu</a>
                                <!-- Button -->
                                <button class="navbar-toggler d-md-none rounded bg-primary text-light" type="button" data-toggle="collapse" data-target="#sidenav" aria-controls="sidenav" aria-expanded="false" aria-label="Toggle navigation">
                                    <span><i class="fa-solid fa-bars"></i></span>
                                </button>
                                <!-- Collapse navbar -->
                                <div class="collapse navbar-collapse" id="sidenav">
                                    <div class="navbar-nav flex-column">
                                        <!-- List -->
                                        <div class="border-bottom">
                                            <div class="m-4">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="avater btn-soft-primary">{{substr(Auth::user()->name,0,1)}}</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <h6 class="d-block font-weight-bold mb-0">{{Auth::user()->name}}</h6>
                                                        <small class="text-muted">{{Auth::user()->email}}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="list-unstyled mb-0">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('user.account')}}"><i class="bx bxs-user"></i> My
                                                Account <i class="fa-solid fa-chevron-right arrowo"></i></a></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('user.change-password')}}"><i class="bx bxs-lock"></i>
                                                Password <i class="fa-solid fa-chevron-right arrowo"></i></a></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('user.address')}}"><i class="bx bxs-book"></i>
                                                Address <i class="fa-solid fa-chevron-right arrowo"></i></a></a>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="nav-link" href="{{route('orders')}}"><i class="bx bxs-cart"></i>
                                                Order <i class="fa-solid fa-chevron-right arrowo"></i></a></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('wishlist')}}"><i class="bx bxs-heart"></i>
                                                Wishlist <i class="fa-solid fa-chevron-right arrowo"></i></a></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('user.invite_earn')}}"><i class="bx bxs-heart"></i>
                                                Invite & Earn<i class="fa-solid fa-chevron-right arrowo"></i></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i>Logout</a>
                                        </li>
                                        <form id="logout-form" method="POST" action="{{route('logout')}}">
                                            @csrf
                                        </form>
                                    </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                        <div class="col-lg-8 col-md-7 col-12">
                            <div class="ml-0 ml-md-4">
                                <div class="d-none d-md-block">
                                <div class="row mb-md-5">
                                    <div class="col">
                                        <h5 class="mb-1 text-orange">Orders</h5>
                                        <p class="mb-0 text-orange small">
                                            You have full control to manage your own orders.
                                        </p>
                                    </div>
                                    <div class="col-auto">
                                        <!--<a href="orders.html" class="btn btn-primary btn-sm"> <i class="ti-angle-left"></i> Go Back</a>-->
                                    </div>
                                </div>
                                </div>
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Order #</th>
                                                    <th>Date Purchased</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order)
                                                <tr>
                                                    <td class="py-3"><a class="nav-link-style fw-medium fs-sm" href="{{route('order-details',['id'=>$order->id])}}">{{$order->order_number}}</a></td>
                                                    <td class="py-3">{{$order->created_at->format('M d Y')}}</td>
                                                    <td class="py-3">
                                                        @if($order->status == 'delivered' )
                                                        <span>{{ucfirst($order->status)}}</span>
                                                        @elseif($order->status == 'canceled')
                                                        <span>{{ucfirst($order->status)}}</span>
                                                        @else
                                                         <span>{{ucfirst($order->status)}}</spna>
                                                        @endif
                                                        
                                                    </td>
                                                    <td class="py-3">₹{{$order->total}}</td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

</div>
@push('scripts')
<script src="https://thinkpureindia.jaipurdreams.com/assets/js/plugins.bundle.js"></script>
@endpush