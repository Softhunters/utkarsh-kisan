 <!-- sa-app__toolbar / end -->
 <!-- sa-app__body -->
 <div id="top" class="sa-app__body">
     <div class="mx-xxl-3 px-4 px-sm-5">
         <div class="py-5">
             <div class="row g-4 align-items-center">
                 <div class="col">
                     <nav class="mb-2" aria-label="breadcrumb">

                     </nav>
                     <h1 class="h3 m-0">All Slider</h1>
                     <span>Slider size 1519*370</span>
                 </div>
                 <div class="col-auto d-flex">
                     <a href="{{route('admin.addslider')}}" class="btn btn-primary">Add Slider</a>
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
                        <div class="p-4"><input type="text" placeholder="Start typing to search for slider" class="form-control form-control--search mx-auto" id="table-search"></div>
                     <!-- <div class="sa-divider"></div> -->
                     <table class="sa-datatables-init" data-order="[[ 1, &quot;asc&quot; ]]" data-sa-search-input="#table-search" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
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
                             @foreach($sliders as $slider)
                             <tr>
                                        <td>{{$slider->id}}</td>
                                        <td>{{$slider->title}}</td>
                                        <td><a href ="{{$slider->link}}">{{$slider->link}}</a></td>
                                        <td>@if($slider->images)
                                                  <img src="{{asset('admin/slider')}}/{{$slider->images}}" width="60" /> 
                                                
                                            @endif
                                        </td>
                                        <td>{{$slider->for}}</td>
                                        <td>@if($slider->status == 1)<a href="#" onclick="confirm('Are you sure you want to Deactive this slider?') || event.stopImmediatePropagation()" wire:click.prevent='DeactiveSlider({{$slider->id}})'> Active </a> 
                                        @else <a href="#" onclick="confirm('Are you sure you want to Active this slider?') || event.stopImmediatePropagation()" wire:click.prevent='ActiveSlider({{$slider->id}})'>Deactive </a>
                                        @endif</td>
                                        <td>{{$slider->created_at}}</td>
                                        <td>
                                        <a href="{{route('admin.editslider',['sid'=> $slider->id])}}"><i class="fa fa-edit"></i></a>
                                                <a href="#" onclick="confirm('Are you sure you want to delete this slider?') || event.stopImmediatePropagation()" wire:click.prevent="deleteSlider({{$slider->id}})" style="margin-left:10px;"><i class="fa fa-times text-danger"></i></a>
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