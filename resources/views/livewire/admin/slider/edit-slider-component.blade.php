
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
                         <h1 class="h3 m-0">Edit Slider</h1>
                     </div>
                     <div class="col-auto d-flex">
                         <a href="{{route('admin.sliders')}}" class="btn btn-primary">All Slider</a>
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
                                             wire:submit.prevent="updateSlider">
                                             <div class="mb-5">
                                                 <h2 class="mb-0 fs-exact-18">Basic information</h2>
                                             </div>
                                             <div class="mb-4">
                                                 <label for="form-category/name" class="form-label">Title</label>
                                                 <input type="text" placeholder="Title" class="form-control"
                                                     wire:model="title" />
                                                 @error('title') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>

                                             <div class="mb-4">
                                                 <label for="form-category/slug" class="form-label">Link</label>
                                                 <div class="input-group input-group--sa-slug">
                                                     <input type="text" placeholder="Link" class="form-control"
                                                         wire:model="link" />
                                                     @error('slug') <p class="text-danger">{{$message}}</p> @enderror
                                                 </div>
                                             </div>

                                             <div class="mb-4">
                                                 <label for="form-category/slug" class="form-label">Image</label>
                                                 <div class="input-group input-group--sa-slug">
                                                    <input type="file" class="form-control" wire:model="newimages" />
                                                    @if($newimages)
                                                        
                                                            <img src="{{$newimages->temporaryUrl()}}" width="120" />
                                                        
                                                    @else
                                                        @if($images)
                                                            <img src="{{asset('admin/slider')}}/{{$images}}" width="120"/>
                                                        @endif
                                                    @endif
                                                     @error('newimages') <p class="text-danger">{{$message}}</p> @enderror
                                                 </div>
                                             </div>
                                             <div class="mb-4">
                                                 <label for="form-banner/image" class="form-label">For</label>
                                                 <div class="input-group input-group--sa-slug">

                                                    <select class="form-control" wire:model="for">
                                                        <option value="home">For Home</option>
                                                        @foreach($categorys as $category)
                                                            <option value="{{$category->id}}"> For {{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('for') <p class="text-danger">{{$message}}</p> @enderror
                                                 </div>
                                             </div>

                                             <div class="mb-4">

                                                 <label for="form-category/parent-category"
                                                     class="form-label">Status</label>

                                                 <select class="form-control input-md" wire:model="status">
                                                     <option value="0">Inactive</option>
                                                     <option value="1">Active</option>
                                                 </select>

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