
 <!-- sa-app__toolbar / end -->
 <!-- sa-app__body -->
 <div id="top" class="sa-app__body">

     <div class="mx-xxl-3 px-4 px-sm-5">
         <div class="py-5">
             <div class="row g-4 align-items-center">
                 <div class="col">
                     <nav class="mb-2" aria-label="breadcrumb">

                     </nav>
                     <h1 class="h3 m-0">Testimonials</h1>
                 </div>
                 <div class="col-auto d-flex">

                     <a href="{{route('admin.addtestimonial')}}" class="btn btn-primary">Add Testimonial</a>
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
                     <!-- <div class="sa-divider"></div> -->
                     <div class="p-4"><input type="text" placeholder="Start typing to search for testimonial" class="form-control form-control--search mx-auto" id="table-search"></div>
                     <table class="sa-datatables-init" data-order="[[ 1, &quot;asc&quot; ]]" data-sa-search-input="#table-search" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                         <thead>
                         <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email Id</th>
                                    <th>Phone Number</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>

                         </thead>
                         <tbody>
                         @foreach($testimonials as $testimonial)
                                    <tr>
                                        <td>{{$testimonial->id}}</td>
                                        <td>{{$testimonial->name}}/{{$testimonial->position}}</td>
                                        <td>{{$testimonial->email}}</td>
                                        <td>{{$testimonial->phone}}</td>
                                        <td>{{$testimonial->image}}</td>
                                        <td>{{$testimonial->description}}</td>
                                        <td>{{$testimonial->star}}</td>
                                        <td>@if($testimonial->status)
                                            <a href="#" onclick="confirm('Are you sure you want to de-active this testimonial?') || event.stopImmediatePropagation()" wire:click.prevent="DeactiveStatus({{$testimonial->id}})" style="margin-left:10px;">Active</a>
                                            @else
                                            <a href="#" onclick="confirm('Are you sure you want to active this testimonial?') || event.stopImmediatePropagation()" wire:click.prevent="ActiveStatus({{$testimonial->id}})" style="margin-left:10px;">Deactive</a>
                                            @endif</td>
                                        <td>
                                            <a href="{{route('admin.edittestimonial',['tid'=>$testimonial->id])}}"><i class="fa fa-edit"></i></a>
                                            @if($testimonial->verified)
                                            <a href="#" onclick="confirm('Are you sure, You want to deverified this testimonial') || event.stopImmediatePropagation()" wire:click.prevent="DeVerifiedstatus({{$testimonial->id}})" style="margin-left:10px;"><i class="fa fa-check text-success"></i></a>
                                            @else
                                            <a href="#" onclick="confirm('Are you sure, You want to verified this testimonial') || event.stopImmediatePropagation()" wire:click.prevent="Verifiedstatus({{$testimonial->id}})" style="margin-left:10px;"><i class="fa fa-times text-danger"></i></a>
                                            @endif
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