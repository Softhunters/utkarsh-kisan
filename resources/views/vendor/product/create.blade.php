@extends('layouts.vendor')
@section('page_css')
    <style>
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
    </style>
@endsection
@section('content')
    <div class="sa-app__body">
        <div class="container py-4">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="mb-4">Filter Products</h3>
                    <form id="productFilterForm" class="row g-3">
                        <div class="col-md-4">
                            <label>Category</label>
                            <select class="form-control" name="category_id" id="categoryDropdown">
                                <option value="">Select Category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Subcategory</label>
                            <select class="form-control" name="subcategory_id" id="subcategoryDropdown">
                                <option value="">Select Subcategory</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Brand</label>
                            <select class="form-control" name="brand_id" id="brandDropdown">
                                <option value="">Select Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 text-end mt-3">
                            <button type="submit" class="btn btn-primary">Apply Filter</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="productList" class="mt-4">
                <!-- Product results will be shown here -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#categoryDropdown').on('change', function() {
            const categoryId = $(this).val();
            $('#subcategoryDropdown').html('<option value="">Loading...</option>');
            $.get(`/vendor/api/subcategories/${categoryId}`, function(data) {
                let options = '<option value="">Select Subcategory</option>';
                data.forEach(sub => options += `<option value="${sub.id}">${sub.name}</option>`);
                $('#subcategoryDropdown').html(options);
            });
        });

        $('#productFilterForm').on('submit', function(e) {
            e.preventDefault();
            const categoryId = $('#categoryDropdown').val();
            const subcategoryId = $('#subcategoryDropdown').val();
            const brandId = $('#brandDropdown').val();

            $('#productList').html('<div class="text-center py-5">Loading products...</div>');

            $.get(`/vendor/api/products`, {
                category_id: categoryId,
                subcategory_id: subcategoryId,
                brand_id: brandId
            }, function(products) {
                if (products.length === 0) {
                    $('#productList').html(
                        '<div class="alert alert-info text-center">No products found.</div>');
                    return;
                }

                let html = `<div class="row">`;
                let url = "{{ asset('admin/product/feat') }}";
                products.forEach(product => {
                    html += `
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card product-card position-relative shadow-sm h-100 border-0">
                                
                                <!-- Discount Badge -->
                                <div class="badge bg-danger text-white position-absolute top-0 start-0 m-2 px-2 py-1" style="font-size: 0.75rem;">
                                    ${product.discount}% Off
                                </div>

                                <!-- Plus Icon -->
                                <div class="position-absolute top-0 end-0 m-2">
                                    <a href="/vendor/products/${product.vendor_product_id}" class="btn btn-sm btn-warning rounded-circle">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>

                                <!-- Thumbnail -->
                                <img src="${url}/${product.thumbnail ?? 'default.png'}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="${product.name}">

                                <div class="card-body text-center">
                                    <!-- Product Name -->
                                    <h6 class="mb-1 text-truncate">
                                        <a href="/vendor/products/${product.vendor_product_id}" class="text-dark text-decoration-none">
                                            ${product.name}
                                        </a>
                                    </h6>

                                    <!-- Price -->
                                    <div class="text-danger fw-bold">₹${product.price}
                                        <small class="text-muted text-decoration-line-through ms-1">₹${product.regular_price}</small>
                                    </div>

                                    <!-- Rating -->
                                    <div class="text-warning small">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <span class="text-muted">0.00 (0)</span>
                                    </div>

                                    <p class="mb-0"><strong>Qty:</strong> ${product.quantity}</p>
                                </div>
                            </div>
                        </div>`;
                });
                html += `</div>`;
                $('#productList').html(html);
            });
        });
    </script>
@endpush
