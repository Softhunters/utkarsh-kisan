<main>
    @section('page_css')
    <link href="{{asset('assets/css/theme.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endsection
      @include('flash-message')
        <div class="accounnt_header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-auto col-6 order-2 order-md-2 col-md-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a class="text-nowrap" href="index.html"><i class="fa fa-home mr-2"></i>Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="text-nowrap" href="{{route('user.account')}}"><i class="fa fa-user mr-2"></i>Account</a>
                                </li>
                                <li class="breadcrumb-item text-nowrap active" aria-current="page">Password</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="order-md-1 text-center text-md-left col-lg col-6 order-1 col-md-6">
                        <h1 class="h3 mb-0 text-orange">Password</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="accounnt_body">
            <div class="container mt-md-n9">
                <div class="row justify-content-between">
                    <div class="col-lg-4 col-md-5 col-12 ">
                        <nav class="navbar navbar-expand-md mb-4 mb-lg-0 sidenav">
                            <!-- Menu -->
                            <a class="d-xl-none d-lg-none d-md-none text-inherit fw-bold" href="#">Sidebar Menu</a>
                            <!-- Button -->
                            <button class="navbar-toggler d-md-none rounded bg-primary text-light" type="button" data-toggle="collapse" data-target="#sidenav" aria-controls="sidenav" aria-expanded="false" aria-label="Toggle navigation">
                                <span ><i class="fa-solid fa-bars"></i></span>
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
                                        <li class="nav-item active">
                                            <a class="nav-link" href="{{route('user.change-password')}}"><i class="bx bxs-lock"></i>
                                                Password <i class="fa-solid fa-chevron-right arrowo"></i></a></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('user.address')}}"><i class="bx bxs-book"></i>
                                                Address <i class="fa-solid fa-chevron-right arrowo"></i></a></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('orders')}}"><i class="bx bxs-cart"></i>
                                                Order <i class="fa-solid fa-chevron-right arrowo"></i></a></a>
                                        </li> 
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('wishlist')}}"><i class="bx bxs-heart"></i>
                                                Wishlist <i class="fa-solid fa-chevron-right arrowo"></i></a></a>
                                        </li>
                                        {{--<li class="nav-item">
                                            <a class="nav-link" href="{{route('user.invite_earn')}}"><i class="bx bxs-heart"></i>
                                                Invite & Earn<i class="fa-solid fa-chevron-right arrowo"></i></a>
                                        </li>--}}
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
                                        <h5 class="mb-1 text-orange">Change Password</h5>
                                        <p class="mb-0 text-orange small">
                                            You have full control to manage your own account setting.
                                        </p>
                                    </div>
                                    <!--<div class="col-auto">-->
                                    <!--    <a href="account.html" class="btn btn-primary btn-sm"> <i class="ti-angle-left"></i> Go Back</a>-->
                                    <!--</div>-->
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                                @endif
                                    <form id="setting_form" method="POST" action="#" wire:submit.prevent="updatepassword" novalidate="novalidate">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-4">
                                                    <label for="" class="form-label">Old Password</label>
                                                        <input name="old_password" type="password" placeholder="Old Password" class="form-control input-lg rounded @error('old_password') is-invalid @enderror" wire:model="old_password">
                                                        @error('old_password') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>     @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-4">
                                                    <label for="" class="form-label">New Password</label>
                                                        <input id="password" type="password" class="form-control input-lg rounded @error('password') is-invalid @enderror" wire:model="password" required autocomplete="new-password" placeholder="New Password">
                                                        @error('password') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>     @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-4">
                                                    <label for="" class="form-label">Confirm Password</label>
                                                    <input id="password-confirm" type="password" class="form-control input-lg rounded" wire:model="password_confirmation" required autocomplete="new-password" placeholder="Confirm new Password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-right mb-0">
                                            <button id="setting_form_btn" type="submit" class="btn btn-primary btn-medium edit_btn">Change Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@push('scripts')
<!-- <script src="https://thinkpureindia.jaipurdreams.com/assets/js/plugins.bundle.js"></script> -->
@endpush