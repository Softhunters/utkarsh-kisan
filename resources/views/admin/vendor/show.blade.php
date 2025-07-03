@extends('layouts.admin1')

@section('content')
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <div class="py-5">
                    <div class="row g-4 align-items-center">
                        <div class="col">
                            <h1 class="h3 m-0">Vendor: {{ $vendor->name }}</h1>
                            <p class="text-muted">Total Products: {{ $vendor->vendorProducts->count() }}</p>
                        </div>
                        <div class="col-auto d-flex">
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>

                <!-- Vendor Profile Section -->
                @if ($vendor->vendorProfile)
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Vendor Profile Details</h5>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-12 mb-2"><strong>Address:</strong>
                                {{ $vendor->vendorProfile->address ?? '-' }}
                            </div>
                            <div class="col-md-4 mb-2"><strong>State:</strong>
                                {{ $vendor->vendorProfile->stateDetail->name ?? '-' }}
                            </div>
                            <div class="col-md-4 mb-2"><strong>City:</strong>
                                {{ $vendor->vendorProfile->cityDetail->name ?? '-' }}
                            </div>
                            <div class="col-md-4 mb-2"><strong>Country:</strong>
                                {{ $vendor->vendorProfile->countryDetail->name ?? '-' }}</div>
                            <div class="col-md-4 mb-2"><strong>Pin Code:</strong>
                                {{ $vendor->vendorProfile->pin_code ?? '-' }}
                            </div>
                            <div class="col-md-4 mb-2"><strong>ID Proof Type:</strong>
                                {{ $vendor->vendorProfile->id_proof_type ?? '-' }}</div>
                            <div class="col-md-4 mb-2">
                                <strong>Proof Image:</strong><br>
                                @if ($vendor->vendorProfile->proof_image)
                                    <a href="{{ asset($vendor->vendorProfile->proof_image) }}" target="_blank">View</a>
                                @else
                                    N/A
                                @endif
                            </div>
                            <div class="col-md-4 mb-2"><strong>GSTIN:</strong>
                                {{ $vendor->vendorProfile->gstin_number ?? '-' }}</div>
                            <div class="col-md-4 mb-2">
                                <strong>GSTIN Image:</strong><br>
                                @if ($vendor->vendorProfile->gstin_image)
                                    <a href="{{ asset($vendor->vendorProfile->gstin_image) }}" target="_blank">View</a>
                                @else
                                    N/A
                                @endif
                            </div>
                            <div class="col-md-4 mb-2">
                                <strong>Status:</strong>
                                @if ($vendor->vendorProfile->status)
                                    <span class="badge bg-success">Verified</span>
                                @else
                                    <span class="badge bg-danger">Not Verified</span>
                                @endif
                            </div>
                            @if (auth()->user()->utype === 'ADM')
                                <div class="col-md-4 mt-2">
                                    <form action="{{ route('admin.vendor.toggleVerification', $vendor->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-primary btn-sm">
                                            @if ($vendor->vendorProfile->status)
                                                Mark as Not Verified
                                            @else
                                                Mark as Verified
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                @foreach ($vendor->vendorProducts as $vp)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">{{ $vp->product->name }}</h5>
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item"><strong>Category:</strong>
                                    {{ $vp->product->category->name ?? '-' }}</li>
                                <li class="list-group-item"><strong>Subcategory:</strong>
                                    {{ $vp->product->subCategories->name ?? '-' }}</li>
                                <li class="list-group-item"><strong>Brand:</strong>
                                    {{ $vp->product->brands->brand_name ?? '-' }}</li>
                                <li class="list-group-item"><strong>Price:</strong> ₹{{ $vp->price }}</li>
                                <li class="list-group-item"><strong>Quantity:</strong> {{ $vp->quantity }}</li>
                                <li class="list-group-item"><strong>Additional Info:</strong><br>{!! $vp->additional_info !!}
                                </li>
                                <li class="list-group-item">
                                    <strong>Status:</strong>
                                    @if ($vp->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </li>
                            </ul>

                            @if ($vp->product->vendorProducts->count() > 1)
                                <div class="mt-3">
                                    <h6>Other Sellers:</h6>
                                    <table class="table table-bordered table-sm">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Vendor</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Info</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($vp->product->vendorProducts as $other)
                                                @if ($other->vendor_id !== $vendor->id)
                                                    <tr>
                                                        <td>{{ $other->vendor->name }}</td>
                                                        <td>₹{{ $other->price }}</td>
                                                        <td>{{ $other->quantity }}</td>
                                                        <td>{!! Str::limit($other->additional_info, 50) !!}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                @if ($vendor->vendorProducts->isEmpty())
                    <div class="alert alert-warning">No products found for this vendor.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
