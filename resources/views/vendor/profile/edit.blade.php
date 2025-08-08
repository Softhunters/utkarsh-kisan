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
                            <h1 class="h3 m-0">Edit Profile</h1>
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

                                            <form action="{{ route('vendor.profile.update') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="row">

                                                    <h5 class="mb-3 mt-2">Vendor Details</h5>

                                                    <div class="col-md-12 mb-3">
                                                        <label>Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ auth()->user()->name ?? '' }}" required>
                                                        @error('name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-12 mb-3">
                                                        <label>Email <span class="text-danger">*</span></label>
                                                        <input type="text" name="email" class="form-control"
                                                            value="{{ auth()->user()->email ?? '' }}" required>
                                                        @error('email')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-12 mb-3">
                                                        <label>Phone Number <span class="text-danger">*</span></label>
                                                        <input type="text" name="phone" class="form-control"
                                                            value="{{ auth()->user()->phone ?? '' }}" required>
                                                        @error('phone')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <!-- Address Details -->
                                                    <h5 class="mb-3 mt-2">Address Details</h5>

                                                    <div class="col-md-12 mb-3">
                                                        <label>Address <span class="text-danger">*</span></label>
                                                        <input type="text" name="address" class="form-control"
                                                            value="{{ $vendorProfile->address ?? '' }}" required>
                                                        @error('address')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Country <span class="text-danger">*</span></label>
                                                        <select name="country" id="countryDropdown" class="form-control"
                                                            required>
                                                            <option value="">Select Country</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}"
                                                                    {{ isset($vendorProfile) && $vendorProfile->country == $country->id ? 'selected' : '' }}>
                                                                    {{ $country->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('country')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>State <span class="text-danger">*</span></label>
                                                        <select name="state" id="stateDropdown" class="form-control"
                                                            required>
                                                            <option value="{{ $vendorProfile->state ?? '' }}">
                                                                {{ $vendorProfile->state ?? 'Select State' }}</option>
                                                        </select>
                                                        @error('state')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>City <span class="text-danger">*</span></label>
                                                        <select name="city" id="cityDropdown" class="form-control"
                                                            required>
                                                            <option value="{{ $vendorProfile->city ?? '' }}">
                                                                {{ $vendorProfile->city ?? 'Select City' }}</option>
                                                        </select>
                                                        @error('city')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 mb-4">
                                                        <label>Pin Code <span class="text-danger">*</span></label>
                                                        <input type="text" name="pin_code" class="form-control"
                                                            value="{{ $vendorProfile->pin_code ?? '' }}" required>
                                                        @error('pin_code')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <!-- ID Proof Section -->
                                                    <h5 class="mb-3 mt-4">ID Proof</h5>

                                                    <div class="col-md-6 mb-3">
                                                        <label>ID Proof Type <span class="text-danger">*</span></label>
                                                        <select name="id_proof_type" class="form-control" required>
                                                            <option value="">Select ID Proof Type</option>
                                                            <option value="Aadhar Card"
                                                                {{ isset($vendorProfile) && $vendorProfile->id_proof_type == 'Aadhar Card' ? 'selected' : '' }}>
                                                                Aadhar Card</option>
                                                            <option value="PAN Card"
                                                                {{ isset($vendorProfile) && $vendorProfile->id_proof_type == 'PAN Card' ? 'selected' : '' }}>
                                                                PAN Card</option>
                                                            <option value="Voter ID"
                                                                {{ isset($vendorProfile) && $vendorProfile->id_proof_type == 'Voter ID' ? 'selected' : '' }}>
                                                                Voter ID</option>
                                                        </select>
                                                        @error('id_proof_type')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Upload ID Proof  <span class="text-danger">*</span><small class="text-muted">(PDF
                                                                Format)</small></label>
                                                        <input type="file" name="proof_image" class="form-control"
                                                            accept=".pdf">
                                                        @if ($vendorProfile->proof_image)
                                                            <a href="{{ asset($vendorProfile->proof_image) }}"
                                                                target="_blank">View Current</a>
                                                        @endif
                                                        @error('proof_image')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <!-- GSTIN Section -->
                                                    <h5 class="mb-3 mt-4">GSTIN Information</h5>

                                                    <div class="col-md-6 mb-3">
                                                        <label>GSTIN Number</label>
                                                        <input type="text" name="gstin_number" class="form-control"
                                                            value="{{ $vendorProfile->gstin_number ?? '' }}">
                                                        @error('gstin_number')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Upload GSTIN Proof <small class="text-muted">(PDF
                                                                Format)</small></label>
                                                        <input type="file" name="gstin_image" class="form-control"
                                                            accept=".pdf">
                                                        @if ($vendorProfile->gstin_image)
                                                            <a href="{{ asset($vendorProfile->gstin_image) }}"
                                                                target="_blank">View Current</a>
                                                        @endif
                                                        @error('gstin_image')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                </div>

                                                <div class="text-center mt-4">
                                                    <button class="btn btn-primary">Update Profile</button>
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
    <script>
        $(document).ready(function() {
            let savedState = "{{ $vendorProfile->state ?? '' }}";
            let savedCity = "{{ $vendorProfile->city ?? '' }}";

            // Fetch states when country changes
            $('select[name="country"]').on('change', function() {
                var countryId = $(this).val();

                if (countryId) {
                    $.ajax({
                        url: '/vendor/getstates/' + countryId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data.status) {
                                var stateSelect = $('select[name="state"]');
                                stateSelect.empty();
                                stateSelect.append('<option value="">Select State</option>');
                                $.each(data.states, function(key, value) {
                                    let selected = (value.id == savedState) ?
                                        'selected' : '';
                                    stateSelect.append('<option value="' + value.id +
                                        '" ' + selected + '>' + value.name +
                                        '</option>');
                                });

                                // Trigger change to load cities if state exists
                                if (savedState) {
                                    stateSelect.trigger('change');
                                }

                                // Clear city if no state
                                if (!savedState) {
                                    $('select[name="city"]').html(
                                        '<option value="">Select City</option>');
                                }
                            }
                        }
                    });
                } else {
                    $('select[name="state"]').html('<option value="">Select State</option>');
                    $('select[name="city"]').html('<option value="">Select City</option>');
                }
            });

            // Fetch cities when state changes
            $('select[name="state"]').on('change', function() {
                var stateId = $(this).val();

                if (stateId) {
                    $.ajax({
                        url: '/vendor/getcities/' + stateId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data.status) {
                                var citySelect = $('select[name="city"]');
                                citySelect.empty();
                                citySelect.append('<option value="">Select City</option>');
                                $.each(data.cities, function(key, value) {
                                    let selected = (value.id == savedCity) ?
                                        'selected' : '';
                                    citySelect.append('<option value="' + value.id +
                                        '" ' + selected + '>' + value.name +
                                        '</option>');
                                });
                            }
                        }
                    });
                } else {
                    $('select[name="city"]').html('<option value="">Select City</option>');
                }
            });

            // Trigger change to load states/cities if editing
            const countryVal = $('select[name="country"]').val();
            if (countryVal) {
                $('select[name="country"]').trigger('change');
            }
        });
    </script>
@endpush
