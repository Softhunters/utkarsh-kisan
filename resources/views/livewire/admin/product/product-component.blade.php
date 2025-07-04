 <!-- sa-app__toolbar / end -->
 <!-- sa-app__body -->
 <div id="top" class="sa-app__body">
    <style>
        .regprice{
            font-weight:300;
            font-size: 13px !important;
            color :#aaaaaa !important;
            text-decoration: line-through;
            padding-left:10px;
        }
    </style>
     <div class="mx-xxl-3 px-4 px-sm-5">
         <div class="py-5">
             <div class="row g-4 align-items-center">
                 <div class="col">
                     <nav class="mb-2" aria-label="breadcrumb">

                     </nav>
                     <h1 class="h3 m-0">Products</h1>
                 </div>
                 <div class="col-auto d-flex">
                     <a href="{{route('admin.addproduct2')}}" class="btn btn-primary">Add New Product</a>
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
                     <div class="p-4"><input type="text" placeholder="Start typing to search for products" class="form-control form-control--search mx-auto" id="table-search"></div>
                     <!-- <div class="sa-divider"></div> -->
                     <table class="sa-datatables-init" data-order="[[ 1, &quot;asc&quot; ]]" data-sa-search-input="#table-search" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                          <thead>
                             <tr>
                                 <th>Id</th>
                                 <th>Title</th>
                                 <th>SLug</th>
                                 <th>Price</th>
                                 <th>Image</th>
                                 <th>Quantity</th>
                                 <th>Category</th>
                                 <th>SubCategory</th>
                                 <th>Status</th>
                                 <!-- <th>Tag</th> -->
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach($products as $product)
                             <tr>

                                 <td>{{$product->id}}</td>
                                 <td>{{$product->name}}</td>
                                 <td>{{$product->slug}}</td>
                                 <td><del><span class="product-price regprice">${{$product->regular_price}}</span></del>{{$product->sale_price}}</td>
                                 <td><img src="{{asset('admin/product/feat')}}/{{$product->image}}" width="60" /></td>
                                 <td>{{$product->quantity}}</td>
                                 <td>{{$product->category->name}}</td>
                                 <td>@if(isset($product->subCategories)){{$product->subCategories->name}} @endif</td>
                                 <td>@if($product->status == 1)<a href="#" onclick="confirm('Are you sure you want to Deactive this product?') || event.stopImmediatePropagation()" wire:click.prevent='DeactiveProduct({{$product->id}})'> Active </a> 
                                @else <a href="#" onclick="confirm('Are you sure you want to active this product?') || event.stopImmediatePropagation()" wire:click.prevent='ActiveProduct({{$product->id}})'>Deactive </a>
                                @endif</td>
                                 <td>
                                     <a href="{{route('admin.editproduct2',['product_slug'=>$product->slug])}}"><i class="fa fa-edit "></i></a>
                                     <a href="#" onclick="confirm('Are you sure you want to delete this product?') || event.stopImmediatePropagation()"
                                         wire:click.prevent="deleteCategory({{$product->id}})" style="margin-left:10px;"><i class="fa fa-times  text-danger ml-2"></i></a>
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