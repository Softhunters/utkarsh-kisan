<div id="top" class="sa-app__body">
     <div class="mx-xxl-3 px-4 px-sm-5">
         <div class="py-5">
             <div class="row g-4 align-items-center">
                 <div class="col">
                     <nav class="mb-2" aria-label="breadcrumb">

                     </nav>
                     <h1 class="h3 m-0">Categories</h1>
                 </div>
                 <div class="col-auto d-flex">
                     <a href="{{route('admin.addsubsubcategory')}}" class="btn btn-primary">Add Sub-Sub-Category</a>
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
                     <div class="p-4"><input type="text" placeholder="Start typing to search for sub-sub-category" class="form-control form-control--search mx-auto" id="table-search"></div>
                     <!-- <div class="sa-divider"></div> -->
                     <table class="sa-datatables-init" data-order="[[ 1, &quot;asc&quot; ]]" data-sa-search-input="#table-search" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                         <thead>
                             <tr>
                                 <th>Id</th>
                                 <th>Sub Sub Category Name</th>
                                 <th>Sub Sub Category Image</th>
                                 <th>Sub Slug</th>
                                 <th>Sub Icon</th>
                                 <th>Category</th>
                                <th>SubCategory</th>  
                                <th>Status</th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach($categories as $category)
                             <tr>
                                 <td>{{$category->id}}</td>
                                 <td>{{$category->name}}</td>
                                 <td><img src="{{asset('admin/category')}}/{{$category->categorythum}}" width="60"></td>
                                 <td>
                                     <div class="badge badge-sa-success">{{$category->slug}}</div>
                                 </td>
                                 <td><img src="{{asset('admin/category/icon')}}/{{$category->icon}}" width="60"></td>
                                 <td>{{$category->category->name}}</td>
                                 <td>{{$category->subcategory->name}}</td>
                                 <td>@if($category->status == 1)<a href="#" onclick="confirm('Are you sure you want to de-active this subcategory?') || event.stopImmediatePropagation()" wire:click.prevent='DeactiveSubCategory({{$category->id}})'> Active </a> 
                                @else <a href="#" onclick="confirm('Are you sure you want to active this sub-sub-category?') || event.stopImmediatePropagation()" wire:click.prevent='ActiveSubCategory({{$category->id}})'>Deactive </a>
                                @endif</td>
                                 <td>
                                     <a href="{{route('admin.editsubsubcategory',['scategory_slug'=>$category->slug])}}"><i class="fa fa-edit"></i></a>
                                     <a href="#" onclick="confirm('Are you sure you want to delete this sub-sub-category?') || event.stopImmediatePropagation()"
                                         wire:click.prevent="deleteCategory({{$category->id}})"><i class="fa fa-times ml-1 text-danger"></i></a>
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