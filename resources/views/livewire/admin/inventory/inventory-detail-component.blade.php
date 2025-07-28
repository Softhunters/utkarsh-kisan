<div id="top" class="sa-app__body">
    <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
        <div class="container container--max--xl">
            <div class="py-5">
                <div class="row g-4 align-items-center">
                    <div class="col">
                        <nav class="mb-2" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-sa-simple">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void()">Inventory</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                            </ol>
                        </nav>
                        <h1 class="h3 m-0">Inventory History - {{ $product->name }}</h1>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body px-5 py-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('admin/product/feat/' . $product->image) }}" width="60" height="60" class="me-3 rounded" alt="">
                        <div>
                            <h5 class="mb-1">{{ $product->name }}</h5>
                            <small class="text-muted">Product ID: #{{ $product->id }}</small>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="sa-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Seller</th>
                                    <th>Order ID</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($product->productHistories->sortByDesc('id') as $index => $history)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <span class="badge {{ $history->type == 'add' ? 'bg-success' : 'bg-danger' }}">
                                                {{ ucfirst($history->type) }}
                                            </span>
                                        </td>
                                        <td>{{ $history->quantity }}</td>
                                        <td>
                                            @if($history->seller)
                                                <a href="{{ route('vendor.profile.show', $history->seller->id) }}" class="text-reset">
                                                    {{ $history->seller->name }}
                                                </a>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($history->orderItem)
                                                <a href="{{ route('admin.order-detail', $history->orderItem->order->id) }}" target="_blank">#{{ $history->orderItem->order->order_number }}</a>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ $history->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No history found for this product.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
