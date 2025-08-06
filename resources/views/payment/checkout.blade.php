@extends('layouts.vendor')

@section('content')
    <!-- sa-app__toolbar / end -->
    <!-- sa-app__body -->
    <div id="top" class="sa-app__body">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <style>
            .singlePrice {
                -webkit-transition: 0.4s;
                transition: 0.4s;
                padding: 33px 23px;
                border: 1px solid #D0D5DD;
                overflow: hidden !important;
                position: relative;
                border-radius: 12px;
                background: #fff;
                -webkit-box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05);
                box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05);
            }

            .mb-24 {
                margin-bottom: 24px;
            }

            .fadeInLeft {
                -webkit-animation-name: fadeInLeft;
                animation-name: fadeInLeft;
            }

            .singlePrice .priceTittle {
                -webkit-transition: 0.4s;
                transition: 0.4s;
                font-family: var(--heading-font);
                color: var #333333 (--heading-color);
                font-size: 24px;
                font-weight: 500;
                margin-bottom: 20px;
            }


            .singlePrice .listing .listItem:last-child {
                /* margin-bottom: 32px; */
                height: 84px;
            }

            .singlePrice .listing .listItem {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                font-family: var(--heading-font);
                color: #475467;
                margin-bottom: 22px;
                font-size: 16px;
            }

            .singlePrice .listing .listItem .icon {
                color: #4CAF50;
                margin-right: 15px;
                font-weight: 700;
            }

            .singlePrice .price {
                -webkit-transition: 0.4s;
                transition: 0.4s;
                color: var(--heading-color);
                font-size: 30px;
                font-weight: 700;
                font-family: var(--body-font);
                margin-bottom: 31px;
                display: block;
            }

            .singlePrice .price>.subTittle {
                font-family: var(--heading-font);
                font-weight: 400;
                color: #667085 !important;
                font-size: 16px;
                background: none;
                padding: 0;
            }

            .singlePrice:hover .priceTittle {
                color: var(--main-color-two);
            }

            .btn-wrapper .cmn-btn-outline1 {
                font-family: var(--heading-font);
                border: 1px solid #D0D5DD;
                color: #667085;
                font-size: 15px;
                font-weight: 500;
                text-transform: normal;
                padding: 14px 15px !important;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -moz-user-select: none;
                cursor: pointer;
                display: inline-block;
                position: relative;
                -webkit-transition: color 0.4s linear;
                transition: color 0.4s linear;
                position: relative;
                overflow: hidden;
                border-radius: 8px;
                background: none;
                z-index: 1;
                width: 100%;
                text-align: center;
            }
        </style>
        <div class="mx-xxl-3 px-4 px-sm-5">
            <div class="py-5">
                <div class="row g-4 align-items-center">
                    <div class="col">
                        <nav class="mb-2" aria-label="breadcrumb">

                        </nav>
                        <h1 class="h3 m-0">My Package</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
            <div class="sa-layout">
                <!-- <div class="sa-layout__backdrop" data-sa-layout-sidebar-close=""></div> -->

                <div class="sa-layout__content">
                    <style>
                        .row {
                            display: -ms-flexbox;
                            display: flex;
                            -ms-flex-wrap: wrap;
                            flex-wrap: wrap;
                            margin: 0 -16px;
                        }

                        .col-25 {
                            -ms-flex: 25%;
                            flex: 25%;
                        }

                        .col-50 {
                            -ms-flex: 50%;
                            flex: 50%;
                        }

                        .col-75 {
                            -ms-flex: 75%;
                            flex: 75%;
                        }

                        .col-25,
                        .col-50,
                        .col-75 {
                            padding: 0 16px;
                        }

                        .container {
                            background-color: #f2f2f2;
                            padding: 5px 20px 15px 20px;
                            border: 1px solid lightgrey;
                            border-radius: 3px;
                        }

                        input[type=text] {
                            width: 100%;
                            margin-bottom: 20px;
                            padding: 12px;
                            border: 1px solid #ccc;
                            border-radius: 3px;
                        }

                        label {
                            margin-bottom: 10px;
                            display: block;
                        }

                        .icon-container {
                            margin-bottom: 20px;
                            padding: 7px 0;
                            font-size: 24px;
                        }

                        .btn {
                            background-color: #04AA6D;
                            color: white;
                            padding: 12px;
                            margin: 10px 0;
                            border: none;
                            width: 100%;
                            border-radius: 3px;
                            cursor: pointer;
                            font-size: 17px;
                        }

                        .btn:hover {
                            background-color: #45a049;
                        }

                        @media (max-width: 800px) {
                            .row {
                                flex-direction: column-reverse;
                            }

                            .col-25 {
                                margin-bottom: 20px;
                            }
                        }
                    </style>

                    <main>
                        <div class="row">
                            <div class="col-75 py-5">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-50">
                                            <div class="mb-5">
                                                <h2 class="mb-0 fs-exact-18">Package Details:</h2>
                                            </div>
                                            <label class="form-label">Package Name:
                                                <strong>{{ $package->pname }}</strong></label>
                                            <label class="form-label">Package Type:
                                                <strong>{{ $package->ptype }}</strong></label>
                                            <label class="form-label">Package Price:
                                                <strong>₹{{ $package->price }}</strong></label>
                                            <label class="form-label">Package Validity (In days):
                                                <strong>{{ $package->validity }}</strong></label>
                                            {{-- <label class="form-label">Visiting Count:
                                                <strong>{{ $package->count }}</strong></label> --}}
                                            <p>{!! $package->description !!}</p>
                                        </div>

                                        {{-- <div class="col-25">
                                            <h3>Payment</h3>
                                            <label>Accepted Cards</label>
                                            <div class="icon-container">
                                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                                            </div>
                                        </div> --}}
                                    </div>

                                    <button id="payBtn" class="btn">Continue to checkout</button>

                                    @if (session('success'))
                                        <div class="alert alert-success mt-3">{{ session('success') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- Razorpay JS --}}
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('payBtn').onclick = function(e) {
            e.preventDefault();

            const options = {
                key: "{{ env('RAZORPAY_KEY') }}",
                amount: "{{ $package->price * 100 }}",
                currency: "INR",
                name: "Utkarsh Kisan",
                description: "Payment for {{ $package->pname }}",
                order_id: "{{ $razorpayOrder['id'] }}",

                handler: function(response) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "{{ route('razorpay.success') }}";

                    // CSRF token
                    form.innerHTML += `<input type="hidden" name="_token" value="{{ csrf_token() }}">`;

                    // Razorpay fields
                    form.innerHTML +=
                        `<input type="hidden" name="razorpay_payment_id" value="${response.razorpay_payment_id}">`;
                    form.innerHTML +=
                        `<input type="hidden" name="razorpay_order_id" value="${response.razorpay_order_id}">`;
                    form.innerHTML +=
                        `<input type="hidden" name="razorpay_signature" value="${response.razorpay_signature}">`;

                    // Package ID
                    form.innerHTML += `<input type="hidden" name="package_id" value="{{ $package->id }}">`;

                    document.body.appendChild(form);
                    form.submit();
                },

                prefill: {
                    name: "{{ auth()->user()->name ?? 'Guest' }}",
                    email: "{{ auth()->user()->email ?? 'guest@example.com' }}"
                },

                theme: {
                    color: "#528FF0"
                }
            };

            const rzp = new Razorpay(options);
            rzp.open();
        }
    </script>
@endpush
