<div>
@section('page_css')
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> -->
@endsection
        <div class="container mt-5">
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h3><strong>Laravel Livewire CRUD with Bootstrap Modal</strong></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 style="float: left;"><strong>All Posts</strong></h5>
                            <button class="btn btn-sm btn-primary" style="float: right;" data-toggle="modal" data-target="#addPosttModal">Add New Post</button>
                        </div>
                        <div class="card-body">
                            @if (session()->has('message'))
                                <div class="alert alert-success text-center">{{ session('message') }}</div>
                            @endif
    
    
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input type="search" class="form-control w-25" placeholder="search" wire:model="searchTerm" style="float: right;" />
                                </div>
                            </div>
    
    
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Category</th>
                                        <th>Cart Value</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($coupons->count() > 0)
                                        @foreach ($coupons as $coupon)
                                            <tr>
                                                <td>{{$coupon->id}}</td>
                                                <td>{{$coupon->coupon_name}}</td>
                                                <td>{{$coupon->code}}</td>
                                                <td>{{$coupon->value == 1 ? 'Percantage': 'FLat'}}</td>
                                                <td>{{$coupon->value}}</td>
                                                <td>@if($coupon->category) {{$coupon->category->category_id}} @endif</td>
                                                <td>{{$coupon->cart_value}}</td>
                                                <td>{{$coupon->status==1 ? 'Active':'Inactive'}}</td>
                                                <td>{{$coupon->created_at}}</td>
                                                <td style="text-align: center;">
                                                    <button class="btn btn-sm btn-secondary" wire:click="viewPostDetails({{ $coupon->id }})">View</button>
                                                    <button class="btn btn-sm btn-primary" wire:click="editPost({{ $coupon->id }})">Edit</button>
                                                    <button class="btn btn-sm btn-danger" wire:click="deleteConfirmation({{ $coupon->id }})">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" style="text-align: center;"><small>No Post Found</small></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="addPosttModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
    
    
                        <form wire:submit.prevent="storePost">
                            <div class="form-group row">
                                <label for="post_id" class="col-3">Post ID</label>
                                <div class="col-9">
                                    
                                </div>
                            </div>
    
    
                            <div class="form-group row">
                                <label for="title" class="col-3">Title</label>
                                <div class="col-9">
                                    <input type="text" id="title" class="form-control" wire:model="coupon_name">
                                    @error('coupon_name')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-3">Code</label>
                                <div class="col-9">
                                    <input type="text" id="code" class="form-control" wire:model="code">
                                    @error('code')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-3">Code</label>
                                <div class="col-9">
                                    <select class="form-control" wire:model="type">
                                        <option value="1">Percantage</option>
                                        <option value="2">Flat</option>
                                    </select>
                                    @error('type') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-3">Value</label>
                                <div class="col-9">
                                    <input type="text" id="value" class="form-control" wire:model="value">
                                    @error('value')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-3">Cart Value</label>
                                <div class="col-9">
                                    <input type="text" id="value" class="form-control" wire:model="cart_value">
                                    @error('cart_value')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-3">Cart Value</label>
                                <div class="col-9">
                                    <select class="form-control" wire:model="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categorys as $category)
                                            <option value="{{$category->id}}"> For {{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
    
    
                            <div class="form-group row">
                                <label for="status" class="col-3">Status</label>
                                <div class="col-9">
                                    <select name="status" id="status" class="form-control" wire:model="status">
                                        <option selected>Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
    
                            
    
    
                            <div class="form-group row">
                                <label for="" class="col-3"></label>
                                <div class="col-9">
                                    <button type="submit" class="btn btn-sm btn-primary">Save Coupon</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
    
        <div wire:ignore.self class="modal fade" id="editPostModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Coupon</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
    
    
                        <form wire:submit.prevent="editPostData">
                            <div class="form-group row">
                                <label for="post_id" class="col-3">Post ID</label>
                                <div class="col-9">
                                    
                                </div>
                            </div>
    
    
                            <div class="form-group row">
                                <label for="title" class="col-3">Title</label>
                                <div class="col-9">
                                    <input type="text" id="title" class="form-control" wire:model="coupon_name">
                                    @error('coupon_name')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-3">Code</label>
                                <div class="col-9">
                                    <input type="text" id="code" class="form-control" wire:model="code">
                                    @error('code')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-3">Code</label>
                                <div class="col-9">
                                    <select class="form-control" wire:model="type">
                                        <option value="1">Percantage</option>
                                        <option value="2">Flat</option>
                                    </select>
                                    @error('type') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-3">Value</label>
                                <div class="col-9">
                                    <input type="text" id="value" class="form-control" wire:model="value">
                                    @error('value')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-3">Cart Value</label>
                                <div class="col-9">
                                    <input type="text" id="value" class="form-control" wire:model="cart_value">
                                    @error('cart_value')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-3">Cart Value</label>
                                <div class="col-9">
                                    <select class="form-control" wire:model="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categorys as $category)
                                            <option value="{{$category->id}}"> For {{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
    
    
                            <div class="form-group row">
                                <label for="status" class="col-3">Status</label>
                                <div class="col-9">
                                    <select name="status" id="status" class="form-control" wire:model="status">
                                        <option selected>Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="" class="col-3"></label>
                                <div class="col-9">
                                    <button type="submit" class="btn btn-sm btn-primary">Edit Coupon</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>  
    
    
        <div wire:ignore.self class="modal fade" id="deletePostModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body pt-4 pb-4">
                        <h6>Are you sure? You want to delete this post!</h6>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-primary" wire:click="cancel()" data-dismiss="modal" aria-label="Close">Cancel</button>
                        <button class="btn btn-sm btn-danger" wire:click="deletePostData()">Yes! Delete</button>
                    </div>
                </div>
            </div>
        </div>  
    
    
        <div wire:ignore.self class="modal fade" id="viewPostModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Post In Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeViewPostModal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID: </th>
                                    <td>{{ $view_counpon_id }}</td>
                                </tr>
    
                                <tr>
                                    <th>Title: </th>
                                    <td>{{ $view_coupon_name }}</td>
                                </tr>
                                <tr>
                                    <th>Code: </th>
                                    <td>{{ $view_coupon_code }}</td>
                                </tr>
                                <tr>
                                    <th>Type: </th>
                                    <td>{{ $view_coupon_type }}</td>
                                </tr>
                                <tr>
                                    <th>Value: </th>
                                    <td>{{ $view_coupon_value }}</td>
                                </tr>
                                <tr>
                                    <th>Category: </th>
                                    <td>{{ $view_coupon_category_id }}</td>
                                </tr>
                                <tr>
                                    <th>Cart Value: </th>
                                    <td>{{ $view_coupon_cart_value }}</td>
                                </tr>
    
                                <tr>
                                    <th>Status: </th>
                                    <td>{{ $view_coupon_status }}</td>
                                </tr>
    
                                <tr>
                                    <th>Date: </th>
                                    <td>{{ $view_coupon_date }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    
    
    @push('scripts')
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script> -->
        <script>
            window.addEventListener('close-modal', event =>{
                $('#addPosttModal').modal('hide');
                $('#editPostModal').modal('hide');
                $('#deletePostModal').modal('hide');
            });
    
    
            window.addEventListener('show-edit-post-modal', event => {
                $('#editPostModal').modal('show');
            });
    
    
            window.addEventListener('show-delete-confirmation-modal', event => {
                $('#deletePostModal').modal('show');
            });
    
    
            window.addEventListener('show-view-post-modal', event => {
                $('#viewPostModal').modal('show');
            });

//             <script>
//     document.addEventListener('livewire:init', () => {
//        Livewire.on('post-created', (event) => {
//            //
//        });
//     });
// </script>
        </script>
    @endpush