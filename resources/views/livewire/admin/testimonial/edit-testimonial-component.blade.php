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
                         <h1 class="h3 m-0">Edit Testimonial</h1>
                     </div>
                     <div class="col-auto d-flex">
                         <a href="{{route('admin.testimonials')}}" class="btn btn-primary">All Testimonial</a>
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
                                         <form class="form-horizontal" enctype="multipart/form-data" wire:submit.prevent="updateTestimonial">
                                         
                                             <div class="mb-5">
                                                 <h2 class="mb-0 fs-exact-18">Basic information</h2>
                                             </div>
                                             <div class="mb-4">
                                                 <label for="form-banner/name" class="form-label">Name<span class="text-danger"> *</span></label>
                                                 <input type="text" placeholder="User Name" class="form-control"
                                                     wire:model="name" />
                                                 @error('name') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>


                                             <div class="mb-4">
                                                 <label for="form-banner/image" class="form-label">Email<span class="text-danger"> *</span></label>
                                                 <div class="input-group input-group--sa-slug">

                                                     <input type="email" class="form-control" wire:model="email" />
                                                 </div>
                                                     @error('email') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>

                                             <div class="mb-4">
                                                 <label for="form-banner/image" class="form-label">Phone<span class="text-danger"> *</span></label>
                                                 <div class="input-group input-group--sa-slug">

                                                     <input type="text" class="form-control" wire:model="phone" />
                                                 </div>
                                                     @error('phone') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>

                                             <div class="mb-4">
                                                 <label for="form-banner/image" class="form-label">Position<span class="text-danger"> *</span></label>
                                                 <div class="input-group input-group--sa-slug">

                                                     <input type="text" placeholder="position" class="form-control"
                                                         wire:model="position" />
                                                 </div>
                                                     @error('position') <p class="text-danger">{{$message}}</p>  @enderror
                                             </div>

                                              <div class="mb-4">
                                                 <label for="form-banner/image" class="form-label">Image<span class="text-danger"> *</span></label>
                                                 <div class="input-group input-group--sa-slug">

                                                     <input type="file" class="form-control" wire:model="newimage" />
                                                     @if($newimage)
                                                        <img src="{{$newimage->temporaryUrl()}}" width="120" />
                                                    @else
                                                        <img src="{{asset('admin/testimonial')}}/{{$image}}" width="120" />
                                                    @endif
                                                 </div>
                                                     @error('newimage') <p class="text-danger">{{$message}}</p> @enderror
                                             </div> 

                                             <div class="mb-4">
                                                 <label for="form-banner/image" class="form-label">Short Description<span class="text-danger"> *</span></label>
                                                 <div class="input-group input-group--sa-slug">

                                                 <textarea class="form-control" id="short_description" placeholder="Short Description" wire:model="short_description"></textarea>
                                                 </div>
                                                 @error('short_description') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>

                                             <div class="mb-4">
                                                 <label for="form-banner/image" class="form-label">Star<span class="text-danger"> *</span></label>
                                                 <div class="input-group input-group--sa-slug">

                                                     <input type="number" class="form-control" placeholder="5" wire:model="star" />
                                                 </div>
                                                     @error('star') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>


                                             <div class="mb-4 text-center">
                                                 <button type="submit" class="btn btn-primary">Update</button>
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