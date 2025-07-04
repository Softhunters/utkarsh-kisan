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
                            <h1 class="h3 m-0">Add Product</h1>
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

                                            <form class="form-horizontal" action="{{ route('vendor.products.store') }}"
                                                method="POST" id="productForm">
                                                @csrf

                                                <div class="row">
                                                    <div class="sa-example__body py-0">
                                                        {{-- Category --}}
                                                        <div class="mb-4">
                                                            <label class="form-label">Category <span
                                                                    class="text-danger">*</span></label>
                                                            <select name="category_id" id="categoryDropdown"
                                                                class="form-control" required>
                                                                <option value="">Select Category</option>
                                                                @foreach ($categories as $cat)
                                                                    <option value="{{ $cat->id }}">{{ $cat->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        {{-- Subcategory --}}
                                                        <div class="mb-4">
                                                            <label class="form-label">Subcategory <span
                                                                    class="text-danger">*</span></label>
                                                            <select name="subcategory_id" id="subcategoryDropdown"
                                                                class="form-control" required>
                                                                <option value="">Select Subcategory</option>
                                                            </select>
                                                        </div>

                                                        {{-- Brand --}}
                                                        <div class="mb-4">
                                                            <label class="form-label">Brand</label>
                                                            <select name="brand_id" id="brandDropdown" class="form-control">
                                                                <option value="">Select Brand</option>
                                                                @foreach ($brands as $brand)
                                                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        {{-- Product --}}
                                                        <div class="mb-4">
                                                            <label class="form-label">Product <span
                                                                    class="text-danger">*</span></label>
                                                            <select name="product_id" id="productDropdown"
                                                                class="form-control" required>
                                                                <option value="">Select Product</option>
                                                            </select>
                                                        </div>

                                                        {{-- Price --}}
                                                        <div class="mb-4">
                                                            <label class="form-label">Price <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" class="form-control" name="price"
                                                                placeholder="Enter Price" required>
                                                        </div>

                                                        {{-- Quantity --}}
                                                        <div class="mb-4">
                                                            <label class="form-label">Quantity <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" class="form-control" name="quantity"
                                                                placeholder="Enter Quantity" required>
                                                        </div>

                                                        {{-- Additional Info --}}
                                                        <div class="mb-4">
                                                            <label class="form-label">Additional Info</label>
                                                            <textarea class="form-control" id="additional_info" name="additional_info" rows="4"></textarea>
                                                        </div>

                                                        <div class="mb-4 text-center">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
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
