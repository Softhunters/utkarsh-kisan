 <!-- sa-app__toolbar / end -->
 <!-- sa-app__body -->
 <div id="top" class="sa-app__body">
     <div class="mx-xxl-3 px-4 px-sm-5">
         <div class="py-5">
             <div class="row g-4 align-items-center">
                 <div class="col">
                     <nav class="mb-2" aria-label="breadcrumb">

                     </nav>
                     <h1 class="h3 m-0">All Banner</h1>
                 </div>
                 <div class="col-auto d-flex">
                     <a href="{{ route('admin.addbanner') }}" class="btn btn-primary">Add Banner</a>
                 </div>
             </div>
         </div>
     </div>
     <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
         <div class="sa-layout">
             <!-- <div class="sa-layout__backdrop" data-sa-layout-sidebar-close=""></div> -->

             <div class="sa-layout__content">
                 <div class="card">
                     @if (Session::has('message'))
                         <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                     @endif
                     <div class="p-4"><input type="text" placeholder="Start typing to search for banner"
                             class="form-control form-control--search mx-auto" id="table-search"></div>
                     <!-- <div class="sa-divider"></div> -->
                     <table class="sa-datatables-init" data-order="[[ 1, &quot;asc&quot; ]]"
                         data-sa-search-input="#table-search" id="DataTables_Table_0" role="grid"
                         aria-describedby="DataTables_Table_0_info">
                         <thead>
                             <tr>
                                 <th>Id</th>
                                 <th>Title</th>
                                 <th>Link</th>
                                 <th>Image</th>
                                 <th>For</th>
                                 <th>Status</th>
                                 <th>Date</th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($sliders as $slider)
                                 <tr>
                                     <td>{{ $slider->id }}</td>
                                     <td>{{ $slider->title }}</td>
                                     <td><a href ="{{ $slider->link }}">{{ $slider->link }}</a></td>
                                     <td>
                                         @if ($slider->images)
                                             @php $images = explode(",",$slider->images); @endphp
                                             @foreach ($images as $image)
                                                 @if ($image)
                                                     <img src="{{ asset('admin/banner') }}/{{ $image }}"
                                                         width="60" />
                                                 @endif
                                             @endforeach
                                         @endif
                                     </td>
                                     <td>{{ $slider->for }}</td>
                                     <td>
                                         @if ($slider->status == 1)
                                             <a href="#"
                                                 onclick="confirm('Are you sure you want to de-active this banner?') || event.stopImmediatePropagation()"
                                                 wire:click.prevent='DeactiveBanner({{ $slider->id }})'> Active </a>
                                         @else
                                             <a href="#"
                                                 onclick="confirm('Are you sure you want to active this banner?') || event.stopImmediatePropagation()"
                                                 wire:click.prevent='ActiveBanner({{ $slider->id }})'>Deactive </a>
                                         @endif
                                     </td>
                                     <td>{{ $slider->created_at }}</td>
                                     <td>
                                         <a href="{{ route('admin.editbanner', ['bid' => $slider->id]) }}" title="Edit"><i
                                                 class="fa fa-edit"></i></a>
                                         <a href="#"
                                             onclick="confirm('Are you sure you want to delete this banner?') || event.stopImmediatePropagation()"
                                             wire:click.prevent="deleteBanner({{ $slider->id }})"
                                             style="margin-left:10px;" title="Delete"><i class="fa fa-times text-danger"></i></a>
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
