<main class="h1-story-area mb-60 pt-60">
    @section('page_css')
    <link href="{{asset('assets/css/theme.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endsection
      @include('flash-message')
    
        <div class="accounnt_header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-auto col-6 order-2 col-md-6 order-md-2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a class="text-nowrap" href="index.html"><i class="bx bxs-home mr-2"></i>Home</a>
                                </li>
                                <li class="breadcrumb-item text-nowrap active" aria-current="page">Account</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="order-md-1 text-center text-md-left col-lg col-6 order-1 col-md-6">
                        <h1 class="h3 mb-0 text-orange">Account</h1>
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
                            <button class="navbar-toggler d-md-none rounded bg-primary text-light" type="button"
                                data-toggle="collapse" data-target="#sidenav" aria-controls="sidenav"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span > <i class="fa-solid fa-bars"></i></span>
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
                                        <li class="nav-item active">
                                            <a class="nav-link" href="{{route('user.account')}}"><i class="bx bxs-user"></i> My
                                                Account <i class="fa-solid fa-chevron-right arrowo"></i></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('user.change-password')}}"><i class="bx bxs-lock"></i>
                                                Password <i class="fa-solid fa-chevron-right arrowo"></i></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('user.address')}}"><i class="bx bxs-book"></i>
                                                Address <i class="fa-solid fa-chevron-right arrowo"></i></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('orders')}}"><i class="bx bxs-cart"></i>
                                                Order <i class="fa-solid fa-chevron-right arrowo"></i></a>
                                        </li> 
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('wishlist')}}"><i class="bx bxs-heart"></i>
                                                Wishlist <i class="fa-solid fa-chevron-right arrowo"></i></a>
                                        </li>
                                      {{--  <li class="nav-item">
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
                                        <h5 class="mb-1 text-orange">Account Details</h5>
                                        <p class="mb-0 text-orange small">
                                            You have full control to manage your own Account.
                                        </p>
                                    </div>
                                    <div class="col-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <form class="row align-items-end" enctype="multipart/form-data"   wire:submit.prevent="UpdateINfo">
                                            <!-- First name -->
                                            <div class="mb-3 col-12 col-lg-6">
                                                <label class="form-label" for="fname">Name</label>
                                                <input type="text" id="fname" class="form-control" placeholder="First Name" wire:model="name">
                                            </div>
                                            <!-- Last name -->
                                            <div class="mb-3 col-12 col-lg-6">
                                                <label class="form-label" for="fname">Number</label>
                                                <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone"  wire:model="phone">
                                                @error('phone') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>    @enderror
                                            </div>
                                            
                                            <div class="mb-3 col-12 col-lg-6">
                                                <label class="form-label" for="fname">Email</label>
                                                <input type="email" id="fname" class="form-control" placeholder="Email" value="{{Auth::user()->email}}" readonly>
                                            </div>
                                            <div class="mb-3 col-12 col-lg-6">
                                                <label class="form-label custom-upload-btn" for="lname" >Photo Upload</label>
                                                <div class="d-lg-flex d-md-flex  ">
                                                <input type="file" id="lname" style="background-color:#5b5b5b;height: 47px;padding: 7px;" class=" @error('newprofile') is-invalid @enderror mb-lg-0 mb-mt-0 mb-4  photo_upload" wire:model="newprofile" >
                                                @if($newprofile)
                                                    <img src="{{$newprofile->temporaryUrl()}}" style="width:50px;height:45px" /> 
                                                @else
                                                    <img src="{{asset('admin/profilespic')}}/{{$profile}}"  style="width:50px;height:45px" />
                                                @endif
                                                </div>
                                                
                                                @error('newprofile') <p class="text-danger">{{$message}}</p> @enderror
                                            </div>
                                            <div class="col-12 mb-3 text-lg-right">
                                                <button class="btn btn-primary edit_btn" type="submit">
                                                    Edit Details
                                                </button>
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
</main>

@push('scripts')
<script src="https://thinkpureindia.jaipurdreams.com/assets/js/plugins.bundle.js"></script>
@endpush