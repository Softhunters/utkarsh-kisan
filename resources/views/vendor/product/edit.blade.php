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
                            <h1 class="h3 m-0">Edit Product</h1>
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
                                        <div class="card-body p-5">
                                            @if (Session::has('message'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ Session::get('message') }}</div>
                                            @endif

                                            <form action="{{ route('vendor.products.update', $vendorProduct->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')

                                                @php
                                                    $product = $vendorProduct->product;
                                                @endphp

                                                <div class="row">
                                                    <div class="sa-example__body py-0">
                                                        {{-- Category --}}
                                                        <div class="mb-4">
                                                            <label class="form-label">Category</label>
                                                            <select name="category_id" id="categoryDropdown"
                                                                class="form-control" required disabled>
                                                                <option value="">Select Category</option>
                                                                @foreach ($categories as $cat)
                                                                    <option value="{{ $cat->id }}"
                                                                        {{ $cat->id == $product->category->id ? 'selected' : '' }}>
                                                                        {{ $cat->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        {{-- Subcategory --}}
                                                        <div class="mb-4">
                                                            <label class="form-label">Subcategory</label>
                                                            <select name="subcategory_id" id="subcategoryDropdown"
                                                                class="form-control" required disabled>
                                                                <option value="{{ $product->subCategories->id }}">
                                                                    {{ $product->subCategories->name }}
                                                                </option>
                                                            </select>
                                                        </div>

                                                        {{-- Brand --}}
                                                        <div class="mb-4">
                                                            <label class="form-label">Brand</label>
                                                            <select name="brand_id" id="brandDropdown" class="form-control" disabled>
                                                                <option value="">Select Brand</option>
                                                                @foreach ($brands as $brand)
                                                                    <option value="{{ $brand->id }}"
                                                                        {{ $brand->id == $product->brands->id ? 'selected' : '' }}>
                                                                        {{ $brand->brand_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        {{-- Product --}}
                                                        <div class="mb-4">
                                                            <input type="hidden" name="product_id" value="{{$vendorProduct->product_id}}">
                                                            <label class="form-label">Product</label>
                                                            <select  id="productDropdown"
                                                                class="form-control" required disabled>
                                                                <option value="{{ $vendorProduct->product_id }}">
                                                                    {{ $product->name }}
                                                                </option>
                                                            </select>
                                                        </div>

                                                        {{-- Price --}}
                                                        <div class="mb-4">
                                                            <label class="form-label">Price</label>
                                                            <input type="number" class="form-control" name="price"
                                                                value="{{ $vendorProduct->price }}" required>
                                                        </div>

                                                        {{-- Quantity --}}
                                                        <div class="mb-4">
                                                            <label class="form-label">Quantity</label>
                                                            <input type="number" class="form-control" name="quantity"
                                                                value="{{ $vendorProduct->quantity }}" disabled>
                                                        </div>

                                                        {{-- Add Quantity --}}
                                                        <div class="mb-4">
                                                            <label class="form-label">Add Quantity</label>
                                                            <input type="number" class="form-control" placeholder="Enter quantity" name="add_quantity"
                                                                value="">
                                                        </div>

                                                        {{-- Additional Info --}}
                                                        <div class="mb-4">
                                                            <label class="form-label">Additional Info</label>
                                                            <textarea class="form-control" id="additional_info" name="additional_info" rows="4">{{ $vendorProduct->additional_info }}</textarea>
                                                        </div>

                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-success">Update</button>
                                                            <a href="{{ route('vendor.products') }}"
                                                                class="btn btn-secondary">Cancel</a>
                                                        </div>
                                                    </div>
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
@endsection
@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#additional_info'))
            .catch(error => {
                console.error(error);
            });

        $('#categoryDropdown').on('change', function() {
            const categoryId = $(this).val();

            $('#subcategoryDropdown').html('<option value="">Loading...</option>');
            $.get(`/vendor/api/subcategories/${categoryId}`, function(data) {
                let options = '<option value="">Select Subcategory</option>';
                data.forEach(sub => options += `<option value="${sub.id}">${sub.name}</option>`);
                $('#subcategoryDropdown').html(options);
            });

            fetchProducts();
        });

        $('#subcategoryDropdown, #brandDropdown').on('change', function() {
            fetchProducts();
        });

        function fetchProducts() {
            const categoryId = $('#categoryDropdown').val();
            const subcategoryId = $('#subcategoryDropdown').val();
            const brandId = $('#brandDropdown').val();

            if (!categoryId || !subcategoryId) {
                $('#productDropdown').html('<option value="">Select Product</option>');
                return;
            }

            $('#productDropdown').html('<option value="">Loading...</option>');

            $.get(`/vendor/api/products`, {
                category_id: categoryId,
                subcategory_id: subcategoryId,
                brand_id: brandId
            }, function(data) {
                let options = '<option value="">Select Product</option>';
                data.forEach(product => options += `<option value="${product.id}">${product.name}</option>`);
                $('#productDropdown').html(options);
            });
        }
    </script>
@endpush
