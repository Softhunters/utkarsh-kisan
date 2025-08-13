@extends('layouts.vendor')

@section('content')
    <!-- sa-app__toolbar / end -->
    <!-- sa-app__body -->
    <div id="top" class="sa-app__body">
        <style>
            .regprice {
                font-weight: 300;
                font-size: 13px !important;
                color: #aaaaaa !important;
                text-decoration: line-through;
                padding-left: 10px;
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
                    @if (auth()->user()->vendorPackage)
                        <div class="col-auto d-flex">
                            <a href="{{ route('vendor.addproduct') }}" class="btn btn-primary">Add New Product</a>
                        </div>
                    @endif
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
                        <div class="p-4"><input type="text" placeholder="Start typing to search for products"
                                class="form-control form-control--search mx-auto" id="table-search"></div>
                        <!-- <div class="sa-divider"></div> -->
                        <table class="sa-datatables-init" data-order="[[ 1, &quot;asc&quot; ]]"
                            data-sa-search-input="#table-search" id="DataTables_Table_0" role="grid"
                            aria-describedby="DataTables_Table_0_info">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>SubCategory</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $p)
                                    @php
                                        $product = $p->product;
                                    @endphp
                                    <tr>

                                        <td>{{ $p->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td><span class="product-price">₹{{ $p->price }}</span>
                                        </td>
                                        <td>{{ $p->quantity }}</td>
                                        <td>{{ $product->brands->brand_name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>
                                            @if (isset($product->subCategories))
                                                {{ $product->subCategories->name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($p->status == 1)
                                                <form action="{{ route('vendor.products.toggleStatus', $p->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-success"
                                                        onclick="return confirm('Are you sure you want to deactivate this product?')">Active</button>
                                                </form>
                                            @else
                                                <form action="{{ route('vendor.products.toggleStatus', $p->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-secondary"
                                                        onclick="return confirm('Are you sure you want to activate this product?')">Deactive</button>
                                                </form>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('vendor.products.edit', ['id' => $p->id]) }}"><i
                                                    class="fa fa-edit "></i></a>
                                            <a href="{{ route('vendor.products.show', ['id' => $p->id]) }}">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <form method="POST" action="{{ route('vendor.products.destroy', $p->id) }}"
                                                class="d-inline-block"
                                                onsubmit="return confirm('Are you sure to delete this?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-transparent border-0"><i
                                                        class="fa fa-times  text-danger ml-2"></i></button>
                                            </form>
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
@endsection
