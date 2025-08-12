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
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
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
    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('vendor.products.store') }}" method="POST" id="addProductForm">
                @csrf
                <input type="hidden" name="product_id" id="modalProductId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Product: <span id="modalProductName"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" required min="1">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" class="form-control" required min="1">
                        </div>
                        <div class="mb-3">
                            <label for="additional_info" class="form-label">Additional Info</label>
                            <textarea name="additional_info" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
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

                        

                                <!-- Plus Icon -->
                                <div class="position-absolute top-0 end-0 m-2">
                                    <button class="btn btn-sm btn-warning rounded-circle openAddModal"
                                        data-id="${product.product_id}"
                                        data-name="${product.name}">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>

                                <!-- Thumbnail -->
                                <img src="${url}/${product.thumbnail ?? 'default.png'}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="${product.name}">

                                <div class="card-body text-center">
                                    <h6 class="mb-1 text-truncate">
                                        <a href="/product-detail/${product.slug}" target="_blank" class="text-dark text-decoration-none">
                                            ${product.name}
                                        </a>
                                    </h6>

                                    <div class="text-danger fw-bold">₹${product.price}
                                        <small class="text-muted text-decoration-line-through ms-1">₹${product.regular_price}</small>
                                    </div>

                                    <div class="text-warning small">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        <i class="far fa-star"></i><i class="far fa-star"></i>
                                        <span class="text-muted">0.00 (0)</span>
                                    </div>

                                   
                                </div>
                            </div>
                        </div>`;

                });
                html += `</div>`;
                $('#productList').html(html);
            });
        });

        $(document).on('click', '.openAddModal', function() {
            const productId = $(this).data('id');
            const productName = $(this).data('name');

            $('#modalProductId').val(productId);
            $('#modalProductName').text(productName);

            const modal = new bootstrap.Modal(document.getElementById('addProductModal'));
            modal.show();
        });
    </script>
@endpush
