 <!-- sa-app__toolbar / end -->
 <!-- sa-app__body -->
 <div id="top" class="sa-app__body">
     <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
         <div class="container">
             <div class="py-5">
                 <div class="row g-4 align-items-center">
                     <div class="col">
                         <nav class="mb-2" aria-label="breadcrumb">

                         </nav>
                         <h1 class="h3 m-0">Edit coupon</h1>
                     </div>
                     <div class="col-auto d-flex">
                         <a href="{{route('admin.coupons')}}" class="btn btn-primary">All Coupon</a>
                     </div>

                 </div>
             </div>

             <div class="row">
                 <div class="col-md-10 m-auto">
                     <div class="sa-entity-layout">
                         <div class="sa-entity-layout__body">
                             <div class="sa-entity-layout__main">
                                 <div class="card">
                                     <div class="card-body p-5">
                                         @if(Session::has('message'))
                                         <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                                         @endif
                                         <form class="form-horizontal" enctype="multipart/form-data"
                                             wire:submit.prevent="updateCoupon">
                                             <div class="mb-5">
                                                 <h2 class="mb-0 fs-exact-18">Basic information</h2>
                                             </div>
                                             <div class="mb-4">
                                                 <label for="form-banner/name" class="form-label">Title<span class="text-danger"> *</span></label>
                                                 <input type="text" placeholder="Title" class="form-control"
                                                     wire:model="coupon_name" />
                                                 @error('coupon_name') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>
                                             <div class="mb-4">
                                                 <label for="form-banner/name" class="form-label">Code<span class="text-danger"> *</span></label>
                                                 <input type="text" placeholder="15" class="form-control"
                                                     wire:model="code" />
                                             </div>
                                                 @error('code') <p class="text-danger">{{$message}}</p> @enderror

                                             <div class="mb-4">
                                                 <label for="form-banner/image" class="form-label">Type<span class="text-danger"> *</span></label>
                                                 <div class="input-group input-group--sa-slug">

                                                    <select class="form-control" wire:model="type">
                                                        <option value="1">Percantage</option>
                                                        <option value="2">Flat</option>
                                                    </select>
                                                 </div>
                                                    @error('type') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>
                                             <div class="mb-4">
                                                 <label for="form-banner/name" class="form-label">Value<span class="text-danger"> *</span></label>
                                                 <input type="text" placeholder="15" class="form-control"
                                                     wire:model="value" />
                                             </div>
                                                 @error('value') <p class="text-danger">{{$message}}</p> @enderror
                                             <div class="mb-4">
                                                 <label for="form-banner/name" class="form-label">Cart Value<span class="text-danger"> *</span></label>
                                                 <input type="text" placeholder="15" class="form-control"
                                                     wire:model="cart_value" />
                                             </div>
                                                 @error('cart_value') <p class="text-danger">{{$message}}</p> @enderror
                                             <div class="mb-4">
                                                 <label for="form-banner/image" class="form-label">Category<span class="text-danger"> *</span></label>
                                                 <div class="input-group input-group--sa-slug">

                                                    <select class="form-control" wire:model="category_id">
                                                        <option value="">Select Category</option>
                                                        @foreach($categorys as $category)
                                                            <option value="{{$category->id}}"> For {{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                 </div>
                                                    @error('for') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>

                                             <div class="mb-4">
                                                 <label for="form-banner/image" class="form-label">Status</label>
                                                 <div class="input-group input-group--sa-slug">

                                                     <select class="form-select" wire:model="status">
                                                         <option value="0">Deactive</option>
                                                         <option value="1">Active</option>
                                                     </select>
                                                 </div>
                                             </div>

                                             <div class="mb-4 text-center">
                                                 <button type="submit" class="btn btn-primary">Upadte</button>
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
 </div>
 <!-- sa-app__body / end -->
 <!-- sa-app__footer -->