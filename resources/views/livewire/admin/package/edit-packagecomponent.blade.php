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
                         <h1 class="h3 m-0">Edit Packge</h1>
                     </div>
                     <div class="col-auto d-flex">
                         <a href="{{route('admin.packages')}}" class="btn btn-primary">All Packages</a>
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
                                         <form class="form-horizontal" wire:submit.prevent="updatePacakge">
                                             <div class="mb-5">
                                                 <h2 class="mb-0 fs-exact-18">Basic information</h2>
                                             </div>
                                             <div class="mb-4">
                                                 <label for="form-package/name" class="form-label">Package Name<span class="text-danger"> *</span></label>
                                                 <input type="text" placeholder="Package Name" class="form-control"
                                                     wire:model="pname" />
                                             </div>
                                                 @error('pname') <p class="text-danger">{{$message}}</p> @enderror
                                             <div class="mb-4">
                                                 <label for="form-package/type" class="form-label">Package Type<span class="text-danger"> *</span></label>
                                                 <div class="input-group input-group--sa-slug">
                                                     <input class="form-control input-md" type="text"
                                                         placeholder="Package Type" wire:model="ptype" />
                                                 </div>
                                                     @error('ptype') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>

                                             <div class="mb-4">
                                                 <label for="form-package/price" class="form-label">Package Price<span class="text-danger"> *</span></label>
                                                 <div class="input-group input-group--sa-slug">
                                                     <input class="form-control input-md" type="text"
                                                         placeholder="Package Price" wire:model="price" />
                                                 </div>
                                                     @error('price') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>

                                             <div class="mb-4">
                                                 <label for="form-package/validity" class="form-label">Package Validity(In days)<span class="text-danger"> *</span></label>
                                                 <div class="input-group input-group--sa-slug">
                                                     <input class="form-control input-md" type="text" placeholder="Package Validity" wire:model="validity" />
                                                 </div>
                                                     @error('validity') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>
                                              {{-- <div class="mb-4">
                                                 <label for="form-package/validity" class="form-label">Visiting Count</label>
                                                 <div class="input-group input-group--sa-slug">
                                                     <input type="text" placeholder="Visiting Validity" class="form-control" wire:model="count" />
                                                 </div>
                                                  @error('count') <p class="text-danger">{{$message}}</p>
                                                     @enderror
                                             </div> --}}
                                             <div class="mb-4">
                                                <label class="control-label">Description<span class="text-danger"> *</span></label>
                                                <div  wire:ignore>
                                                    <textarea class ="form-control" id="description" placeholder="Description" wire:model="description">{{$description}}</textarea>
                                                </div>
                                                    @error('description') <p class="text-danger">{{$message}}</p> @enderror
                                            </div>

                                             <div class="mb-4">
                                                 <label for="form-package/upto" class="form-label">Package Valid Upto</label>
                                                 <div class="input-group input-group--sa-slug">
                                                     <input class="form-control input-md" type="date" id="sale-date"
                                                         placeholder="YYYY/MM/DD hh:mm:ss" wire:model="up_to" />
                                                 </div>
                                                    @error('count') <p class="text-danger">{{$message}}</p> @enderror
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

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create( document.querySelector( '#description' ) )
            .then(editor => {
                editor.model.document.on('change:data', () => {
                @this.set('description', editor.getData());
                })
            })
        .catch( error => {
            console.error( error );
        } );
                    
</script>
    <script>
//         tinymce.init({
//   selector: '#description',  // change this value according to your HTML
//   plugins: 'lists',
//   toolbar: 'numlist bullist'
// });

    </script>
     <script>
        $(function() {
            $('#sale-date').on('dp.change', function(ev) {
                var data = $('#sale-date').val();
                @this.set('sale_date', data);
            });
        });
    </script>
    
 @endpush