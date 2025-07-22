<div>
     @section('page_css')
    <link href="{{asset('assets/css/theme.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endsection
      @include('flash-message')
    <section class="section-padding mt-5">
        <div class="container">
            <div class="row justify-content-between">
                
                <div class="col-md-8">
                    <div class="card mb-md-5">
                        <div class="card-body">
                            <div class="row">
                                @if(isset($ships[0]))
                                    <div class="row">
                                        @foreach($ships as $ship)
                                            <div class="col-lg-6">
                                                <div class="address-block bg-light rounded p-3"> 
                                                    <!--<a href="#" class="edit_address" data-toggle="modal" data-dismiss="modal" data-target="#address_model">-->
                                                    <!--    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>-->
                                                    <!--</a>-->
                                                    <!--<a href="#" class="delete_address">-->
                                                    <!--    <i class="fa fa-trash text-danger" aria-hidden="true"></i>-->
                                                    <!--</a>-->
                                                    <h6>My {{ucfirst($ship->address_type)}} Address</h6>
                                                    <span class="text-muted">{{$ship->name}}</span><br><span class="text-muted">{{$ship->mobile}}</span><br>
                                                    <span class="text-muted">{{$ship->line2}} {{$ship->line1}}  - {{$ship->zipcode}}</span>
                                                    <br>
                                                    <div class="d-flex gap-3">
                                                    <input type="radio" name="selected_address" value="{{$ship->id}}"  wire:model="selected_address" @if($ship->default_address) checked  @endif>
                                                    <span style="padding-top:5px">This address</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                        
                                    </div>
                                    <div class="text-lg-right  mt-4 mb-4">
                                        <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#address_model"  wire:click.prevent="addressmodal"  class="btn btn-primary btn-sm edit_btn Address_btn"> Add Another Address</a>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#address_model"  wire:click.prevent="addressmodal" class="btn btn-primary btn-sm edit_btn"> Add Your First Addres</a>
                                    </div>
                                @endif 
                                                          
                            </div>
                            @if(isset($ships[0]))
                                @if(Session::has('message'))
                                    <div class="alert alert-success">
                                        <strong>Alert </strong>{{Session::get('message')}}
                                    </div>
                                @endif
                                @if(Session::has('stripe_error'))
									<div class="alert alert-danger" role="alert">{{Session::get('stripe_error')}}</div>
								@endif
                                <div id="accordion">
                                    {{-- <div class="accordion-item">
                                        <div class="accordion-title" id="cc">
                                            <h5 class="mb-0" data-toggle="collapse" data-target="#collapseOne"
                                            @if($payment_type == 'cc')  aria-expanded="true" @endif wire:click.prevent="paymentmethod('cc')"> Pay with Credit Card <i class="fa-solid  @if($payment_type == 'cc') fa-chevron-down @else fa-chevron-right @endif arrowos"></i></h5>
                                        </div>
                                        <div class="accordion-content collapse @if($payment_type == 'cc') show @endif" id="collapseOne"
                                            data-parent="#accordion">
                                            <div class="accordion-content-inner">
                                                <p class="py-4">We accept following credit cards:&nbsp;&nbsp;<img class="d-inline-block align-middle" src="{{asset('assets/img/payment-methods.png')}}" style="width: 187px;" alt="Cerdit Cards"></p>
                                                <form wire:submit.prevent="placeOrdercc" onsubmits = "$('#processing').show();">
                                                    <div class="col-sm-6 mb-4">
                                                        <input class="form-control" type="text"
                                                            name="number" placeholder="Card Number" required wire:model="card_no">
                                                            @error('card_no') <span class="text-danger">{{$message}}</span> @enderror
                                                    </div>
                                                    <div class="col-sm-6 mb-4">
                                                        <input class="form-control" type="text" name="name"
                                                            placeholder="Full Name" required wire:model="card_name">
                                                    </div>
                                                    <div class="col-sm-3 mb-4">
                                                        <!-- <input class="form-control" type="text" name="expiry" placeholder="MM/YY" required wire:model="card_no"> -->
                                                            <input type="text" name="exp-month" value="" placeholder="MM" wire:model="exp_month">
                                                            @error('exp_month') <span class="text-danger">{{$message}}</span> @enderror
                                                    </div>
                                                    <div class="col-sm-3 mb-4">
                                                        <!-- <input class="form-control" type="text" name="expiry" placeholder="MM/YY" required wire:model="card_no"> -->
                                                            <input type="text" name="exp-year" value="" placeholder="YYYY" wire:model="exp_year">
                                                                @error('exp_year') <span class="text-danger">{{$message}}</span> @enderror
                                                            </div>
                                                    <div class="col-sm-3 mb-4">
                                                        <input class="form-control" type="text" name="cvc"
                                                            placeholder="CVC" required wire:model="cvc">
                                                    </div>
                                                    <div class="col-sm-6 mb-4">
                                                    <button type="submit" class="btn btn-medium">Place
                                                            order</button>
                                                    </div>
                                                
                                                </form>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="accordion-item">
                                        <!-- accordion Title -->
                                        <div class="accordion-title" id="paypal">
                                            <h5 class="mb-0" data-toggle="collapse" data-target="#collapseTwo" @if($payment_type =='paypal')  aria-expanded="true" @endif wire:click.prevent="paymentmethod('paypal')">Pay with EasyBuzz <i class="fa-solid @if($payment_type == 'paypal') fa-chevron-down @else fa-chevron-right @endif arrowos"></i></h5>
                                        </div>
                                        <!-- accordion Content -->
                                        <div class="collapse accordion-content @if($payment_type == 'paypal') show @endif" id="collapseTwo" data-parent="#accordion">
                                            <div class="accordion-content-inner">
                                                <p class="pt-4 mb-0 pb-2"><span class="font-weight-bold">EasyBuzz</span> - the safer, easier way to pay</p>
                                                <a href="#" wire:click.prevent="placeordereasybuzz" class="btn btn-primary">Checkout with PayPal</a>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="accordion-item">
                                        <!-- accordion Title -->
                                        <div class="accordion-title" id="cod">
                                            <h5 class="mb-0" data-toggle="collapse" data-target="#collapseThree" @if($payment_type == 'cod')  aria-expanded="true" @endif wire:click.prevent="paymentmethod('cod')"> Pay later  <i class="fa-solid @if($payment_type == 'cod') fa-chevron-down @else fa-chevron-right @endif arrowos"></i>
                                            </h5>
                                        </div>
                                        <!-- accordion Content -->
                                        <div class="collapse accordion-content  @if($payment_type == 'cod') show @endif" id="collapseThree" data-parent="#accordion">
                                            <div class="accordion-content-inner">
                                                <p class="pt-4 mb-0 pb-3"><span class="font-weight-bold">Cash On Delevary</span> -Buy Now Pay Later for all your shopping</p>
                                                                
                                                <a href="#"  wire:click.prevent="placeordercod" class="btn btn-medium "><button class="btn btn-primary edit_btn">Place order</button></a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                                        @if($errors->isEmpty())
                                                    <div wire:ignore id ="processing" style="font-size:22px; margin-bottom:20px; padding-left:37px; color:green; display:none;">
                                                        <i class="fa fa-spinner fa-pulse fa-fw"></i>
                                                        <span>Processing....</span>
                                                    </div>
                                                @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mt-lg-0 mt-6">
                    <!--<h6 class="font-weight-bold">Deliver to</h6>-->
                    <!--<div class="mb-4">-->
                    <!--    <select class="form-control">-->
                    <!--        <option value="s">Siliguri - 734001</option>-->
                    <!--        <option value="s" selected>Delhi - 110002</option>-->
                    <!--        <option value="s">Kolkata - 700027</option>-->
                    <!--    </select>-->
                    <!--</div>-->
                    <div class="cart-summary">
                        <div class="cart-summary-wrap">
                            <h4>Cart Summary</h4>
                            <p>Sub Total <span>₹{{$subtotalfinal}}</span></p>
                            <p>Shipping Fee <span>₹{{$shopping_charge}}</span></p>
                            @if($finaldiscount)
                            <p>Discount <span>₹{{$finaldiscount}}</span></p>
                            @endif
                            @if($payment_type == "cod")
                                <!--<p>Charge COD <span>₹50.00</span></p>-->
                            @endif
                            <h2>Grand Total <span>₹{{$shiptotal}}</span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                                    <label class="form-label" for="apt">LandMark</label>
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
                                    
                                    <select id="state" wire:model="state_id"class="form-control custom-select" wire:change="changestate">
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
                                        <option value="">Select State</option>
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
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
                                    <label class="form-label " for="country">Address Type</label>
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
                        <div class="col-md-12" style="padding-left:0px !important; padding-right:0px !important">
                                <div class="mb-4 d-flex gap-3 align-items-center">
                                    <!-- <label class="form-label" for="postal_code">make My default address</label> -->
                                    <input type="checkbox" id="vehicle1" name="default_address" value="1" wire:model="default_address"> 
                                    <label for="vehicle1" class="mb-0"> Make my default address</label><br>
                                </div>
                            </div>
                        <button type="submit" id="address_btn" name="submit" class="btn btn-primary btn-full btn-medium rounded edit_btn">Add Address</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@push('scripts')
    <script>
            window.addEventListener('close-modal', event =>{
                $('#address_model').modal('hide');
                
            });
        
            window.addEventListener('show-add-address-modal', event => {
                $('#address_model').modal('show');
            });

    </script>
@endpush