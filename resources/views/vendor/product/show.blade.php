@extends('layouts.vendor')

@section('content')
    <div id="top" class="sa-app__body">

        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <div class="py-5">
                    <div class="row g-4 align-items-center">
                        <div class="col">
                            <nav class="mb-2" aria-label="breadcrumb">

                            </nav>
                            <h1 class="h3 m-0">Product Details</h1>
                        </div>
                        <div class="col-auto d-flex">
                            <a href="{{ route('vendor.products') }}" class="btn btn-primary">All Products</a>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 m-auto">
                        <div class="sa-entity-layout">
                            <div class="sa-entity-layout__body">
                                <div class="sa-entity-layout__main">
                                    <div class="card">
                                        <div class="card-body">
                                            <p><strong>Product:</strong> {{ $vendorProduct->product->name }}</p>
                                            <p><strong>Category:</strong>
                                                {{ $vendorProduct->product->category->name ?? '-' }}</p>
                                            <p><strong>Subcategory:</strong>
                                                {{ $vendorProduct->product->subCategories->name ?? '-' }}</p>
                                            <p><strong>Brand:</strong>
                                                {{ $vendorProduct->product->brands->brand_name ?? '-' }}</p>
                                            <p><strong>Price:</strong> ₹{{ $vendorProduct->price }}</p>
                                            <p><strong>Quantity:</strong> {{ $vendorProduct->quantity }}</p>
                                            <p><strong>Additional Info:</strong><br>{!! $vendorProduct->additional_info !!}</p>

                                            <div class="mt-4">
                                                <a href="{{ route('vendor.products.edit', $vendorProduct->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <form method="POST"
                                                    action="{{ route('vendor.products.destroy', $vendorProduct->id) }}"
                                                    class="d-inline-block"
                                                    onsubmit="return confirm('Are you sure to delete this?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
                                                <a href="{{ route('vendor.products') }}" class="btn btn-secondary">Back</a>
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
    </div>
@endsection
