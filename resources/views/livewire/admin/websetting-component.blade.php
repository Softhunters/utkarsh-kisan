 <div id="top" class="sa-app__body">
     <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
         <div class="container">
             <div class="py-5">
                 <div class="row g-4 align-items-center">
                     <div class="col">
                         <nav class="mb-2" aria-label="breadcrumb">
                         </nav>
                         <h1 class="h3 m-0">Edit Websetting</h1>
                     </div>
                     <div class="col-auto d-flex">
                         
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

                                         <form class="form-horizontal" wire:submit.prevent="saveSettings">
                                             <div class="mb-5">
                                                 <h2 class="mb-0 fs-exact-18">Basic information</h2>
                                             </div>
                                             <div class="mb-4">
                                                 <label for="form-category/name" class="form-label">Web Site Name</label>
                                                 <input type="text" placeholder="Web Site Name" class="form-control"  wire:model="site_name" />
                                                     @error('site_name') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>
                                             <div class="mb-4">
                                                 <label for="form-category/slug" class="form-label">Email</label>
                                                 <div class="input-group input-group--sa-slug">
                                                    <input type="email" placeholder="Email" class="form-control input-md" wire:model="email" />
                                                    @error('email') <p class="text-danger">{{$message}}</p> @enderror
                                                 </div>
                                             </div>
                                             <div class="mb-4">
                                                    <label for="form-category/parent-category" class="form-label">Phone</label>
                                                    <input type="text" placeholder="Phone" class="form-control input-md"  wire:model="phone"/>
                                                    @error('phone') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>
                                             <div class="mb-4">
                                                    <label for="form-category/parent-category" class="form-label">Phone2</label>
                                                    <input type="text" placeholder="Phone" class="form-control input-md"  wire:model="phone2"/>
                                                    @error('phone2') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>
                                             <div class="form-group mb-4">
                                                <label class="col-md-4 control-label form-label">Web Logo</label>
                                                <div class="col-md-4">
                                                    <input type="file" placeholder="Category Icon" class="form-control input-md"  wire:model="newweb_logo"/>
                                                    @if($newweb_logo)
                                                        <img src="{{$newweb_logo->temporaryUrl()}}" width="120" />
                                                    @else
                                                        <img src="{{asset('admin/logos')}}/{{$web_logo}}" width="120" />
                                                    @endif
                                                    @error('web_logo') <p class="text-danger">{{$message}}</p> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label class="col-md-4 control-label form-label">Fav Icon</label>
                                                <div class="col-md-4">
                                                    <input type ="file" class ="input-file" wire:model="newfavicon"/>
                                                    @if($newfavicon)
                                                        <img src="{{$newfavicon->temporaryUrl()}}" width="120" />
                                                    @else
                                                        <img src="{{asset('admin/logos')}}/{{$favicon}}" width="120" />
                                                    @endif
                                                    @error('newfavicon') <p class="text-danger">{{$message}}</p> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label class="col-md-4 control-label form-label">Mobile Logo</label>
                                                <div class="col-md-4">
                                                    <input type ="file" class ="input-file" wire:model="newmobile_logo"/>
                                                    @if($newmobile_logo)
                                                        <img src="{{$newmobile_logo->temporaryUrl()}}" width="120" />
                                                    @else
                                                        <img src="{{asset('admin/logos')}}/{{$mobile_logo}}" width="120" />
                                                    @endif
                                                    @error('newmobile_logo') <p class="text-danger">{{$message}}</p> @enderror
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label for="form-category/parent-category" class="form-label">For Address</label>
                                                <input type="text" placeholder="Address" class="form-control input-md"  wire:model="address"/>
                                                @error('address') <p class="text-danger">{{$message}}</p> @enderror
                                            </div>
                                            
                                        <div class="d-flex gap-3">    
                                            <div class="mb-4 col-md-6">
                                                <label for="form-category/parent-category" class="form-label">For Map</label>
                                                <input type="text" placeholder="Map" class="form-control input-md"  wire:model="map"/>
                                                @error('map') <p class="text-danger">{{$message}}</p> @enderror
                                            </div>
                                            <div class="mb-4 col-md-6">
                                                <label for="form-category/parent-category" class="form-label">For Twiter</label>
                                                <input type="text" placeholder="Twiter" class="form-control input-md"  wire:model="twiter"/>
                                                @error('twiter') <p class="text-danger">{{$message}}</p> @enderror
                                            </div>
                                        </div>   
                                        
                                        <div class="d-flex gap-3">
                                            <div class="form-group mb-4 col-md-6 ">
                                                <label class=" form-label">Facebook</label>
                                                <div>
                                                    <input type="text" placeholder="Facebook" class="form-control input-md"  wire:model="facebook"/>
                                                    @error('facebook') <p class="text-danger">{{$message}}</p> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group mb-4 col-md-6">
                                                <label class=" form-label">Pinterest</label>
                                                <div >
                                                    <input type="text" placeholder="Pinterest" class="form-control input-md"  wire:model="pinterest"/>
                                                    @error('pinterest') <p class="text-danger">{{$message}}</p> @enderror
                                                </div>
                                            </div>
                                        </div>  
                                        
                                        <div class="d-flex gap-3">
                                            <div class="form-group mb-4 col-md-6">
                                                <label class=" form-label">Instagram</label>
                                                <div >
                                                    <input type="text" placeholder="Instagram" class="form-control input-md"  wire:model="instagram"/>
                                                    @error('instagram') <p class="text-danger">{{$message}}</p> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group mb-4 col-md-6">
                                                <label class=" form-label">Youtube</label>
                                                <div >
                                                    <input type="text" placeholder="Youtube" class="form-control input-md"  wire:model="youtube"/>
                                                    @error('youtube') <p class="text-danger">{{$message}}</p> @enderror
                                                </div>
                                            </div>
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
 