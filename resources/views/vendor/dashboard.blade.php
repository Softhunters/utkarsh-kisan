@extends('layouts.vendor')

@section('content')
    <div id="top" class="sa-app__body px-2 px-lg-4">
        <div class="container pb-6">
            <div class="py-5">
                <div class="row g-4 align-items-center">
                    <div class="col">
                        <h1 class="h3 m-0">Dashboard</h1>
                    </div>
                    <div class="col-auto d-flex">
                        <!--<select class="form-select me-3">-->
                        <!--    <option selected="">7 October, 2021</option>-->
                        <!--</select>-->
                        <!--<a href="#" class="btn btn-primary">Export</a>-->
                    </div>
                </div>
            </div>
            <div class="row g-4 g-xl-5">
                <div class="col-12 col-md-4 d-flex">
                    <div class="card saw-indicator flex-grow-1" data-sa-container-query='{"340":"saw-indicator--size--lg"}'>
                        <div class="sa-widget-header saw-indicator__header">
                            <h2 class="sa-widget-header__title">Total Users</h2>

                        </div>

                        <div class="d-flex">
                            <div class="col-md-6">
                                <img class="sidebaar1" src="{{ asset('assets/images/logo/user__1.png') }}">
                            </div>


                            <div class="saw-indicator__body">
                                <div class="saw-indicator__value"><a href="{{ route('admin.users') }}"
                                        class="sa-nav__link">{{ $users }}</a></div>
                                <div class="saw-indicator__delta saw-indicator__delta--rise">
                                    <div class="saw-indicator__delta-direction">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9"
                                            viewBox="0 0 9 9" fill="currentColor">
                                            <path d="M9,0L8,6.1L2.8,1L9,0z"></path>
                                            <circle cx="1" cy="8" r="1"></circle>
                                            <rect x="0" y="4.5"
                                                transform="matrix(0.7071 -0.7071 0.7071 0.7071 -2.864 4.0858)"
                                                width="7.1" height="2"></rect>
                                        </svg>
                                    </div>
                                    <div class="saw-indicator__delta-value">34.7%</div>
                                </div>
                                <div class="saw-indicator__caption">Compared to April 2021</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 d-flex">
                    <div class="card saw-indicator flex-grow-1" data-sa-container-query='{"340":"saw-indicator--size--lg"}'>
                        <div class="sa-widget-header saw-indicator__header">
                            <h2 class="sa-widget-header__title">Total Products</h2>
                        </div>

                        <div class="d-flex">
                            <div class="col-md-6">
                                <img class="sidebaar1" src="{{ asset('assets/images/logo/2 (2).png') }}">
                            </div>

                            <div class="saw-indicator__body">
                                <div class="saw-indicator__value"><a href="{{ route('admin.products2') }}"
                                        class="sa-nav__link">{{ $products_c }}</a></div>
                                <div class="saw-indicator__delta saw-indicator__delta--fall">
                                    <div class="saw-indicator__delta-direction">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9"
                                            viewBox="0 0 9 9" fill="currentColor">
                                            <path d="M2.8,8L8,2.9L9,9L2.8,8z"></path>
                                            <circle cx="1" cy="1" r="1"></circle>
                                            <rect x="0" y="2.5" transform="matrix(0.7071 0.7071 -0.7071 0.7071 3.5 -1.4497)"
                                                width="7.1" height="2"></rect>
                                        </svg>
                                    </div>
                                    <div class="saw-indicator__delta-value">12.0%</div>
                                </div>
                                <div class="saw-indicator__caption">Compared to April 2021</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 d-flex">
                    <div class="card saw-indicator flex-grow-1" data-sa-container-query='{"340":"saw-indicator--size--lg"}'>
                        <div class="sa-widget-header saw-indicator__header">
                            <h2 class="sa-widget-header__title">Total Pets</h2>
                        </div>

                        <div class="d-flex">
                            <div class="col-md-6">
                                <img class="sidebaar1" src="{{ asset('assets/images/logo/3 (2).png') }}">
                            </div>

                            
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                    <div class="card flex-grow-1 saw-pulse" data-sa-container-query='{"560":"saw-pulse--size--lg"}'>
                        <div class="sa-widget-header saw-pulse__header">
                            <h2 class="sa-widget-header__title">Active users</h2>

                        </div>
                        <div class="saw-pulse__counter">{{ $active_u }}</div>
                        <div class="sa-widget-table saw-pulse__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>User Id</th>
                                        <th class="text-end">User Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users_data as $user)
                                        <tr>
                                            <td><a href="#" class="text-reset">{{ $user->id }}</a></td>
                                            <td class="text-end">{{ $user->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                    <div class="card flex-grow-1 saw-chart"
                        data-sa-data='[{"label":"Jan","value":50},{"label":"Feb","value":130},{"label":"Mar","value":525},{"label":"Apr","value":285},{"label":"May","value":470},{"label":"Jun","value":130},{"label":"Jul","value":285},{"label":"Aug","value":240},{"label":"Sep","value":710},{"label":"Oct","value":470},{"label":"Nov","value":640},{"label":"Dec","value":1110}]'>
                        <div class="sa-widget-header saw-chart__header">
                            <h2 class="sa-widget-header__title">Income statistics</h2>

                        </div>
                        <div class="saw-chart__body">
                            <div class="saw-chart__container"><canvas></canvas></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                    <div class="card flex-grow-1 saw-pulse" data-sa-container-query='{"560":"saw-pulse--size--lg"}'>
                        <div class="sa-widget-header saw-pulse__header">
                            <h2 class="sa-widget-header__title">Brands</h2>
                        </div>
                        <div class="saw-table__body sa-widget-table text-nowrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Image</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>{{ $brand->id }}</td>
                                            <td>
                                                {{-- <a href="{{ route('brand-products', ['brand_slug' => $brand->brand_slug]) }}"
                                                    class="text-reset">{{ $brand->brand_name }}</a> --}}
                                                </td>
                                            <td>
                                                {{-- <a href="{{ route('brand-products', ['brand_slug' => $brand->brand_slug]) }}"
                                                    class="text-reset"><img
                                                        src="{{ asset('admin/brand') }}/{{ $brand->brand_image }}"
                                                        width="60" /></a> --}}
                                                    </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                    <div class="card flex-grow-1 saw-chart">
                        <div class="sa-widget-header saw-chart__header">
                            <h2 class="sa-widget-header__title">Category Details</h2>
                        </div>
                        <div class="saw-table__body sa-widget-table text-nowrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Sub Sub Category</th>
                                        <th>Total Products</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>
                                                {{-- <a href="{{ route('product.category', ['category_slug' => $category->slug]) }}"
                                                    class="items">{{ $category->name }}</a> --}}
                                                </td>
                                            <td>{{ $category->subCategories->count() }}</td>
                                            <td>{{ $category->subsubCategories->count() }}</td>
                                            <td>{{ $category->productcount->count() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-lg-8 col-xxl-7 d-flex">
                    <div class="card flex-grow-1 saw-table">
                        <div class="sa-widget-header saw-table__header">
                            <h2 class="sa-widget-header__title">Recent Products</h2>
                            <div class="sa-widget-header__actions">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm btn-sa-muted d-block"
                                        id="widget-context-menu-6" data-bs-toggle="dropdown" aria-expanded="false"
                                        aria-label="More">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="3" height="13"
                                            fill="currentColor">
                                            <path
                                                d="M1.5,8C0.7,8,0,7.3,0,6.5S0.7,5,1.5,5S3,5.7,3,6.5S2.3,8,1.5,8z M1.5,3C0.7,3,0,2.3,0,1.5S0.7,0,1.5,0 S3,0.7,3,1.5S2.3,3,1.5,3z M1.5,10C2.3,10,3,10.7,3,11.5S2.3,13,1.5,13S0,12.3,0,11.5S0.7,10,1.5,10z">
                                            </path>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="widget-context-menu-6">
                                        <li><a class="dropdown-item" href="#">Settings</a></li>
                                        <li><a class="dropdown-item" href="#">Move</a></li>
                                        <li>
                                            <hr class="dropdown-divider" />
                                        </li>
                                        <li><a class="dropdown-item text-danger" href="#">Remove</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="saw-table__body sa-widget-table text-nowrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>is_verified</th>
                                        <th>Name</th>
                                        <th>Images</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                {{-- <a href="{{ route('product-details', ['slug' => $product->slug]) }}"
                                                    class="text-reset">{{ $product->id }}</a> --}}
                                                </td>
                                            <td>
                                                <div class="d-flex fs-6">
                                                    <div class="badge badge-sa-primary">Pending</div>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <a
                                                    href="{{ route('product-details', ['slug' => $product->slug]) }}">{{ $product->name }}</a> --}}
                                            </td>
                                            <td><img src="{{ asset('admin/product/feat') }}/{{ $product->image }}"
                                                    width="60" /></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 col-xxl-7 d-flex">
                    <div class="card flex-grow-1 saw-table">
                        <div class="sa-widget-header saw-table__header">
                            <h2 class="sa-widget-header__title">Top Products</h2>
                            <div class="sa-widget-header__actions">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm btn-sa-muted d-block"
                                        id="widget-context-menu-6" data-bs-toggle="dropdown" aria-expanded="false"
                                        aria-label="More">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="3" height="13"
                                            fill="currentColor">
                                            <path
                                                d="M1.5,8C0.7,8,0,7.3,0,6.5S0.7,5,1.5,5S3,5.7,3,6.5S2.3,8,1.5,8z M1.5,3C0.7,3,0,2.3,0,1.5S0.7,0,1.5,0 S3,0.7,3,1.5S2.3,3,1.5,3z M1.5,10C2.3,10,3,10.7,3,11.5S2.3,13,1.5,13S0,12.3,0,11.5S0.7,10,1.5,10z">
                                            </path>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="widget-context-menu-6">
                                        <li><a class="dropdown-item" href="#">Settings</a></li>
                                        <li><a class="dropdown-item" href="#">Move</a></li>
                                        <li>
                                            <hr class="dropdown-divider" />
                                        </li>
                                        <li><a class="dropdown-item text-danger" href="#">Remove</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="saw-table__body sa-widget-table text-nowrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>is_verified</th>
                                        <th>Name</th>
                                        <th>Images</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topProducts as $tproduct)
                                        <tr>
                                            <td><a href="{{ route('product-details', ['slug' => $tproduct->product->slug]) }}"
                                                    class="text-reset">{{ $tproduct->product->id }}</a></td>
                                            <td>
                                                <div class="d-flex fs-6">
                                                    <div class="badge badge-sa-primary">Pending</div>
                                                </div>
                                            </td>
                                            <td><a
                                                    href="{{ route('product-details', ['slug' => $tproduct->product->slug]) }}">{{ $tproduct->product->name }}</a>
                                            </td>
                                            <td><img src="{{ asset('admin/product/feat') }}/{{ $tproduct->product->image }}"
                                                    width="60" /></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
