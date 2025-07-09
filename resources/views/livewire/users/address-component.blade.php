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
                                    <a class="text-nowrap" href="{{route('user.account')}}"><i class="fa fa-home mr-2"></i>Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="text-nowrap" href="{{route('user.account')}}"><i class="fa fa-user mr-2"></i>Account</a>
                                </li>
                                <li class="breadcrumb-item text-nowrap active" aria-current="page">Address</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="order-md-1 text-center text-md-left col-lg col-6 order-1 col-md-6">
                        <h1 class="h3 mb-0 text-orange">Address</h1>
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
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('user.change-password')}}"><i class="bx bxs-lock"></i>
                                                Password <i class="fa-solid fa-chevron-right arrowo"></i></a></a>
                                        </li>
                                        <li class="nav-item active">
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
                            <div class="d-md-block">
                                <div class="row   mb-md-5">
                                    <div class="col d-none d-md-block">
                                        <h5 class="mb-1 text-orange">Address</h5>
                                        <p class="mb-0 text-orange small">
                                            You have full control to manage your own account setting.
                                        </p>
                                    </div>
                                    <div class="col-auto">
                                    <a href="#" wire:click.prevent="adddress"  class="btn btn-primary btn-sm edit_btn"> Add New Address</a>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-lg-5"></div>
                            <div class="card mt-lg-0 mb-lg-0 mt-md-0 mb-md-0 mt-5 mb-5">
                                <div class="card-body">
                                    <div class="row">
                                        @if(isset($ships[0]))
                                            @foreach($ships as $ship)
                                            
                                                <div class="col-lg-6">
                                                    <div class="address-block bg-light rounded p-3 mb-md-3 mb-3">
                                                        <a href="#" class="edit_address" wire:click="editPost({{ $ship->id }})">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="#" class="delete_address" wire:click="deleteConfirmation({{ $ship->id }})">
                                                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                                        </a>
                                                        <h6>{{$ship->name}}</h6>
                                                        <span class="text-muted">{{$ship->line2}} {{$ship->line1}}- {{$ship->zipcode}}</span><br>
                                                        <span class="text-muted">{{$ship->landmark}}</span>
                                                        <p class="text-muted">{{$ship->mobile}}. {{$ship->mobile_optional}}</p>
                                                        
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                        <p> No Address Added yet</p>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div wire:ignore.self class="modal clean_modal clean_modal-lg" id="address_model" tabindex="-1" aria-labelledby="address_model" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              
                <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                    <form  wire:submit.prevent="addAddress">
                        <div class="form-group">
                            <input name="name" required type="text" placeholder="Name" class="form-control input-lg rounded" wire:model="name">
                            @error('name') <p class="text-danger">{{$message}}</p> @enderror
                        </div>
                        <div class="form-group">
                            <input name="phone" required type="text" placeholder="Phone Number" class="form-control input-lg rounded" wire:model="mobile">
                            @error('mobile') <p class="text-danger">{{$message}}</p> @enderror
                        </div>
                        <div class="form-group">
                            <input name="phone_optional"  type="text" placeholder="Alternative Phone Number" class="form-control input-lg rounded" wire:model="mobile_optional">
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label class="form-label" for="address">Address</label>
                                    <input type="text" required class="form-control" name="address" id="address" wire:model="line1">
                                    @error('line1') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label" for="apt">Apt / Suite / Floor</label>
                                    <input type="text" class="form-control" name="line2" id="apt" wire:model="line2">
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label" for="apt">Landmark</label>
                                    <input type="text" class="form-control" name="landmark" id="apt" wire:model="landmark">
                                    @error('landmark') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" class="form-control" for="locality">Country</label>
                                    <!-- <input type="text" required class="form-control" name="country_id" id="locality" wire:model="country_id"> -->
                                    <select id="conutry" wire:model="country_id" class="form-control custom-select" wire:change="changecountry">
                                        <option value="">Select country</option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="administrative_area_level_1">State</label>
                                    
                                    <select id="state" wire:model="state_id" class="form-control custom-select" wire:change="changestate">
                                        <option value="">Select State</option>
                                        @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('state_id') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="locality">City</label>
                                    
                                    <select id="city" class="form-control custom-select" wire:model="city_id">
                                        <option value="">Select City</option>
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('city_id') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="postal_code">ZIP Code</label>
                                    <input type="text" required class="form-control" name="zipcode" wire:model="zipcode">
                                    @error('zipcode') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label class="form-label" for="country">Address Type</label>
                                    <div class="d-flex gap-4 align-items-center">
                                    <input type="radio" name="address_type" value="home"  wire:model="address_type">For Home
                                    <input type="radio" name="address_type" value="office"  wire:model="address_type">For Office
                                    <input type="radio" name="address_type" value="other"  wire:model="address_type">For Other
                                    </div>
                                    <!-- <input type="radio" id="age1" name="age" value="30"> -->
                                    @error('address_type') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 default_myaddress">
                                <div class="mb-4 d-flex gap-3 align-items-center">
                                    <!-- <label class="form-label" for="postal_code">make My default address</label> -->
                                    <input type="checkbox" id="vehicle1" name="default_address" value="1" wire:model="default_address"> 
                                    <label for="vehicle1"> Make my default address</label><br>
                                </div>
                            </div>
                        <button type="submit" id="address_btn" name="submit" class="btn btn-primary btn-full btn-medium rounded edit_btn">Add Address</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="deletePostModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="close cancel_btn" data-dismiss="modal" aria-label="Close" wire:click="close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h6>Are you sure? You want to delete this address!</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="cancel()" data-dismiss="modal" aria-label="Close">Cancel</button>
                    <button class="btn btn-sm btn-danger edit_btn" wire:click="deletePostData()">Yes! Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal clean_modal clean_modal-lg" id="editPostModal" tabindex="-1" aria-labelledby="editPostModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                
                
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                    <form  wire:submit.prevent="updateAddress">
                        <div class="form-group">
                            <input name="name" required type="text" placeholder="Name" class="form-control input-lg rounded" wire:model="name">
                            @error('name') <p class="text-danger">{{$message}}</p> @enderror
                        </div>
                        <div class="form-group">
                            <input name="phone" required type="text" placeholder="Phone Number" class="form-control input-lg rounded" wire:model="mobile">
                            @error('mobile') <p class="text-danger">{{$message}}</p> @enderror
                        </div>
                        <div class="form-group">
                            <input name="phone_optional"  type="text" placeholder=" Alternative Phone Number" class="form-control input-lg rounded" wire:model="mobile_optional">
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label class="form-label" for="address">Address</label>
                                    <input type="text" required class="form-control" name="address" id="address" wire:model="line1">
                                    @error('line1') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label" for="apt">Apt / Suite / Floor</label>
                                    <input type="text" class="form-control" name="line2" id="apt" wire:model="line2">
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label" for="apt">LandMark</label>
                                    <input type="text" class="form-control" name="landmark" id="apt" wire:model="landmark">
                                    @error('landmark') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="locality">Country</label>
                                    <!-- <input type="text" required class="form-control" name="country_id" id="locality" wire:model="country_id"> -->
                                    <select id="conutry" wire:model="country_id" class="form-control" wire:change="changecountry">
                                        <option value="">Select country</option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="administrative_area_level_1">State</label>
                                    
                                    <select id="state" wire:model="state_id" class="form-control" wire:change="changestate">
                                        <option value="">Select State</option>
                                        @foreach($states as $state)
                                        <option value="{{$state->id}}" @if($state->id == $state_id) selected @endif>{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('state_id') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="locality">City</label>
                                    
                                    <select id="city" wire:model="city_id"class="form-control">
                                        <option value="">Select State</option>
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}"  @if($city->id == $city_id) selected @endif>{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('city_id') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="postal_code">ZIP code</label>
                                    <input type="text" required class="form-control" name="zipcode" wire:model="zipcode">
                                    @error('zipcode') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label class="form-label" for="country">Address Type</label>
                                    <div class="d-flex gap-4">
                                    <input type="radio" name="address_type" value="home"  wire:model="address_type">For Home
                                    <input type="radio" name="address_type" value="office"  wire:model="address_type">For Office
                                    <input type="radio" name="address_type" value="other"  wire:model="address_type">For Other
                                    <!-- <input type="radio" id="age1" name="age" value="30"> -->
                                    </div>
                                    @error('address_type') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                                <div class="mb-4 d-flex gap-3">
                                    <!-- <label class="form-label" for="postal_code">make My default address</label> -->
                                    <input type="checkbox" id="vehicle1" name="default_address" value="1" wire:model="default_address"> 
                                    <label for="vehicle1"> Make my default address</label><br>
                                </div>
                            </div>
                        <button type="submit" id="address_btn" name="submit" class="btn btn-primary btn-full btn-medium rounded">Add Address</button>
                    </form>
                </div>
            </div>
        </div>
    </div>  
    
</main>

@push('scripts')
<script src="https://thinkpureindia.jaipurdreams.com/assets/js/plugins.bundle.js"></script>
    <script>
        
            window.addEventListener('close-modal', event =>{
                $('#address_model').modal('hide');
                $('#deletePostModal').modal('hide');
                $('#editPostModal').modal('hide');
                
            });
        
            window.addEventListener('show-add-address-modal', event => {
                $('#address_model').modal('show');
            });
            window.addEventListener('show-delete-confirmation-modal', event => {
                $('#deletePostModal').modal('show');
            });
            window.addEventListener('show-edit-post-modal', event => {
                $('#editPostModal').modal('show');
            });

            
    </script>
@endpush