 <!-- sa-app__toolbar / end -->
 <!-- sa-app__body -->
 <div id="top" class="sa-app__body">
     <div class="mx-xxl-3 px-4 px-sm-5">
         <div class="py-5">
             <div class="row g-4 align-items-center">
                 <div class="col">
                     <nav class="mb-2" aria-label="breadcrumb">

                     </nav>
                     <h1 class="h3 m-0">Categories  </h1>
                 </div>
                 <div class="col-auto d-flex">
                     <a href="{{route('admin.addcategory')}}" class="btn btn-primary">Add Category</a>
                 </div>
             </div>
         </div>
     </div>
     <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
         <div class="sa-layout">
             <!-- <div class="sa-layout__backdrop" data-sa-layout-sidebar-close=""></div> -->

             <div class="sa-layout__content">
                 <div class="card">
                     @if(Session::has('message'))
                     <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                     @endif

                     <div class="p-4"><input type="text" placeholder="Start typing to search for category" class="form-control form-control--search mx-auto" id="table-search"></div>
                     <!-- <div class="sa-divider"></div> -->
                     <table class="sa-datatables-init" data-order="[[ 1, &quot;asc&quot; ]]" data-sa-search-input="#table-search" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                         <thead>
                             <tr>
                                 <th>Id</th>
                                 <th>Category Name</th>
                                 {{-- <th>Category Image</th> --}}
                                 <th>Slug</th>
                                 <th>Icon</th>
                                 <th>SubCategory</th>
                                 <th>Is Home</th>
                                 <th>Status</th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach($categories as $category)
                             <tr>
                                 <td>{{$category->id}}</td>
                                 <td>{{$category->name}}</td>
                                 {{-- <td><img src="{{asset('admin/category')}}/{{$category->categorythum}}" width="60"></td> --}}
                                 <td>
                                    <div class="badge badge-sa-success">{{$category->slug}}</div>
                                 </td>
                                 <td>
                                    <img src="{{asset('admin/category/icon')}}/{{$category->icon}}" width="60">
                                 </td>
                                 <td>
                                     <ul class="sclist">
                                         @foreach($category->subCategories as $key => $scategory)
                                         @if($key == 4)
                                            <a href="{{route('admin.subcategories')}}">View more...</a>
                                            @break
                                        @endif
                                         <li><i class="fa fa-caret-right"></i>{{$scategory->name}}
                                             <a href="{{route('admin.editsubcategory',['scategory_slug'=>$scategory->slug])}}"
                                                 class="slink"><i class="fa fa-edit"></i></a>
                                             <a href="#" onclick="confirm('Are you sure you want to delete this sub-category?') || event.stopImmediatePropagation()"
                                                 wire:click.prevent="deleteSubCategory({{$scategory->id}})" class="slink"><i class="fa fa-times text-danger"></i></a>
                                         </li>
                                         @endforeach
                                     </ul>
                                 </td>
                                 <td>@if($category->is_home == 1) Yes @else No @endif</td>
                                 <td>@if($category->status == 1)<a href="#" onclick="confirm('Are you sure you want to de-active this category?') || event.stopImmediatePropagation()" wire:click.prevent='DeactiveCategory({{$category->id}})'> Active </a> 
                                @else <a href="#" onclick="confirm('Are you sure you want to active this category?') || event.stopImmediatePropagation()" wire:click.prevent='ActiveCategory({{$category->id}})'>Deactive </a>
                                @endif</td>
                                 <td>
                                     <a href="{{route('admin.editcategory',['category_slug'=>$category->slug])}}" title="Edit"><i class="fa fa-edit"></i></a>
                                     <a href="#" onclick="confirm('Are you sure you want to delete this category?') || event.stopImmediatePropagation()"
                                         wire:click.prevent="deleteCategory({{$category->id}})" style="margin-left:10px;" title="Delete"><i class="fa fa-times ml-1 text-danger"></i></a>
                                 </td>
                             </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>