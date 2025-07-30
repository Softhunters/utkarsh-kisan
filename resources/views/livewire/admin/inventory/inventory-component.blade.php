<div id="top" class="sa-app__body">
    <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
        <div class="container">
            <div class="py-5">
                <div class="row g-4 align-items-center">
                    <div class="col">
                        <nav class="mb-2" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-sa-simple">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Product Inventory</li>
                            </ol>
                        </nav>
                        <h1 class="h3 m-0">Product Inventory</h1>
                    </div>
                    <!-- <div class="col-auto d-flex"><a href="app-order.html" class="btn btn-primary">New order</a></div> -->
                </div>
            </div>
            <div class="card">
                <div class="p-4"><input type="text" placeholder="Start typing to search for orders"
                        class="form-control form-control--search mx-auto" id="table-search" /></div>
                <div class="sa-divider"></div>
                <table class="sa-datatables-init text-nowrap" data-order='[[ 1, "desc" ]]'
                    data-sa-search-input="#table-search">
                    <thead>
                        <tr>
                            <th class="w-min" data-orderable="false"><input type="checkbox"
                                    class="form-check-input m-0 fs-exact-16 d-block" aria-label="..." /></th>
                            <th>Product</th>
                            <th>price</th>
                            <th>Total Added</th>
                            <th>Total Spent</th>
                            <th>Available</th>
                            <th>Action</th>
                            <th class="w-min" data-orderable="false"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventories as $inventory)
                            <tr>
                                <td><input type="checkbox" class="form-check-input m-0 fs-exact-16 d-block"
                                        aria-label="..." /></td>
                                <td><a href="{{ route('product-details', ['slug' => $inventory['slug'], 'vendor_id' => $inventory['vendor_id']]) }}"
                                        class="text-reset" target="_blank">{{ Str::limit($inventory['name'], 60) }}</a></td>
                                <td>{{ $inventory['price'] }}</td>
                                <td>{{ $inventory['total_add'] }}</td>
                                <td>{{ $inventory['total_spent'] }}</td>
                                <td>{{ $inventory['available'] }}</td>
                                <td>
                                    <a class="dropdown-item text-danger"
                                        href="{{ route('admin.inventory.details', $inventory['id']) }}">Details</a>
            </div>
            </td>
            </tr>
            @endforeach

            </tbody>
            </table>
        </div>
    </div>
</div>
</div>
