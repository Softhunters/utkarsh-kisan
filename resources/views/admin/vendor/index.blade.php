@extends('layouts.admin1')

@section('content')
    <div id="top" class="sa-app__body">
        <div class="mx-xxl-3 px-4 px-sm-5">
            <div class="py-5">
                <div class="row g-4 align-items-center">
                    <div class="col">
                        <h1 class="h3 m-0">
                            @if ($type === 'active') Active Vendors
                            @elseif ($type === 'deactivated') Deactivated Vendors
                            @else Unverified Vendors
                            @endif
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
            <div class="sa-layout">
                <div class="sa-layout__content">
                    <div class="card">
                        <div class="p-4">
                            <input type="text" placeholder="Search vendors" class="form-control form-control--search mx-auto" id="table-search">
                        </div>

                        <table class="sa-datatables-init" data-sa-search-input="#table-search">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Vendor Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Verification</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendors as $vendor)
                                    <tr>
                                        <td>{{ $vendor->id }}</td>
                                        <td>{{ $vendor->name }}</td>
                                        <td>{{ $vendor->email }}</td>
                                        <td>{{ $vendor->phone }}</td>
                                        <td>{{ $vendor->vendorProfile->address ?? 'N/A' }}</td>
                                        {{-- <td>
                                            @if ($vendor->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Deactivated</span>
                                            @endif
                                        </td> --}}
                                        <td>
                                            @if ($vendor->status == 1)
                                                <form action="{{ route('admin.vendor.toggleStatus', $vendor->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-success"
                                                        onclick="return confirm('Are you sure you want to deactivate this vendor?')">Active</button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.vendor.toggleStatus', $vendor->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-secondary"
                                                        onclick="return confirm('Are you sure you want to activate this vendor?')">Deactive</button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($vendor->vendorProfile && $vendor->vendorProfile->status)
                                                <span class="badge bg-success p-3">Verified</span>
                                            @else
                                                <span class="badge bg-warning p-3">Unverified</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('vendor.profile.show', $vendor->id) }}" class="btn btn-sm btn-primary">View</a>
                                            {{-- <a href="{{ route('vendor.profile.edit', $vendor->id) }}" class="btn btn-sm btn-info">Edit</a> --}}
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
