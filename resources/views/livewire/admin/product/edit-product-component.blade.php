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
                        <a href="{{ route('admin.products2') }}" class="btn btn-primary">All Products</a>
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
                                        <form class="form-horizontal" enctype="multipart/form-data"
                                            wire:submit.prevent="updateProduct">
                                            <div class="mb-3">
                                                <h2 class="mb-0 fs-exact-18">Basic information</h2>
                                            </div>

                                            <div class="row">
                                                <div class="sa-example__body py-0">
                                                    <div class="mb-4">
                                                        <label class="form-label">Product Name<span class="text-danger">
                                                                *</span></label>
                                                        <input type="text" placeholder="Title" class="form-control"
                                                            wire:model="name" wire:keyup="generateSlug" />
                                                        @error('name')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="form-category/slug" class="form-label">Product
                                                            Slug<span class="text-danger"> *</span></label>
                                                        <div class="input-group input-group--sa-slug">
                                                            <input type="text" placeholder="Category Slug"
                                                                class="form-control" wire:model="slug" />
                                                            @error('slug')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="control-label">Description<span
                                                                class="text-danger"> *</span></label>
                                                        <div wire:ignore>
                                                            <textarea class ="form-control" id="description" placeholder="Description" wire:model="description">{!! $description !!}</textarea>
                                                            @error('description')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="control-label">Additional Info<span
                                                                class="text-danger"> *</span></label>
                                                        <div wire:ignore>
                                                            <textarea class ="form-control" id="additional_info" placeholder="Additional Info" wire:model="additional_info">{!! $additional_info !!}</textarea>
                                                            @error('additional_info')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="control-label">Manufacturer Details<span
                                                                class="text-danger"> *</span></label>
                                                        <div wire:ignore>
                                                            <textarea class ="form-control" id="manufacturer_details" placeholder="Manufacturer Details"
                                                                wire:model="manufacturer_details">{!! $manufacturer_details !!}</textarea>
                                                            @error('manufacturer_details')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-4">
                                                                <label class="form-label">Regular Price<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="input-group input-group--sa-slug">
                                                                    <input type="text" placeholder="₹price"
                                                                        class="form-control"
                                                                        wire:model="regular_price" />
                                                                    @error('regular_price')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-4">
                                                                <label class="form-label">Sale Price<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="input-group input-group--sa-slug">
                                                                    <input type ="text" placeholder="Sale Price"
                                                                        class ="form-control input-md"
                                                                        wire:model="sale_price" />
                                                                    @error('sale_price')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-4">
                                                                <label class="form-label">Quantity</label>
                                                                <input type ="text" placeholder="10"
                                                                    class ="form-control input-md"
                                                                    wire:model="quantity" disabled/>
                                                                @error('quantity')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-4">
                                                                <label class="form-label">Add Quantity</label>
                                                                <input type ="text" placeholder="eg:10"
                                                                    class ="form-control input-md"
                                                                    wire:model="newquantity"/>
                                                                @error('newquantity')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">SKU<span
                                                                        class="text-danger"> *</span></label>
                                                                <input type ="text" placeholder="SKU"
                                                                    class ="form-control input-md" wire:model="SKU" />
                                                                @error('SKU')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Stock Status<span
                                                                        class="text-danger"> *</span></label>
                                                                <select class="form-control"
                                                                    wire:model="stock_status">
                                                                    <option value="instock">InStock</option>
                                                                    <option value="outofstock">Out Stock</option>
                                                                </select>
                                                                @error('stock_status')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="my-2">
                                                                <label class="form-label">Featured<span
                                                                        class="text-danger"> *</span></label>
                                                                <select class="form-control" wire:model="featured">
                                                                    <option value="0">No</option>
                                                                    <option value="1">Yes</option>
                                                                </select>
                                                                @error('featured')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Tax SLab<span
                                                                        class="text-danger"> *</span></label>
                                                                <select class="form-control" wire:model="tax_id">
                                                                    <option value="">Select Tax Slab</option>
                                                                    @foreach ($taxs as $tax)
                                                                        <option value="{{ $tax->id }}">
                                                                            {{ $tax->tax_name }} {{ $tax->value }}%
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('tax_id')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Free Delivery<span
                                                                        class="text-danger"> *</span></label>
                                                                <select class="form-control"
                                                                    wire:model="freecancellation">
                                                                    <option value="">Select</option>
                                                                    <option value="0">No</option>
                                                                    <option value="1">Yes</option>
                                                                </select>
                                                                @error('freecancellation')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Category<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="col-md-12">
                                                                    <select class="form-control"
                                                                        wire:model="category_id"
                                                                        wire:change="changeSubcategory">
                                                                        <option value="">Select Category</option>
                                                                        @foreach ($categories as $category)
                                                                            <option value="{{ $category->id }}">
                                                                                {{ $category->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('category_id')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Sub-Category</label>
                                                                <div class="col-md-12">
                                                                    <select class="form-control"
                                                                        wire:model="scategory_id"
                                                                        wire:change="changeSubSubcategory">
                                                                        <option value="0">Select Sub Category
                                                                        </option>
                                                                        @foreach ($scategories as $scategory)
                                                                            <option value="{{ $scategory->id }}">
                                                                                {{ $scategory->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('scategory_id')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Sub-Sub-Category</label>
                                                                <div class="col-md-12">
                                                                    <select class="form-control"
                                                                        wire:model="sbcategory_id">
                                                                        <option value="">Select Sub Sub Category
                                                                        </option>
                                                                        @foreach ($subcategories as $sbcategory)
                                                                            <option value="{{ $sbcategory->id }}">
                                                                                {{ $sbcategory->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('sbcategory_id')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>



                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="my-2">
                                                                <label for="form-banner"
                                                                    class="form-label">Brands<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="col-md-12">
                                                                    <select class="form-control"
                                                                        wire:model="brand_id">
                                                                        <option value="">Select Brand Name
                                                                        </option>
                                                                        @foreach ($brands as $brand)
                                                                            <option value="{{ $brand->id }}">
                                                                                {{ $brand->brand_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('brand_id')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-4">
                                                                <label class="form-label">HSN Code<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="input-group input-group--sa-slug">
                                                                    <input type ="text" placeholder="HSN Code"
                                                                        class ="form-control input-md"
                                                                        wire:model="hsn_code" />
                                                                    @error('hsn_code')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="formFile-1" class="form-label">Thumbnail
                                                            Images<span class="text-danger"> *</span></label>
                                                        <input type="file" class="form-control" id="formFile-1"
                                                            wire:model="newimage">
                                                        @if ($newimage)
                                                            <img src="{{ $newimage->temporaryUrl() }}"
                                                                width="120" />
                                                        @else
                                                            <img src="{{ asset('admin/product/feat') }}/{{ $image }}"
                                                                width="120" />
                                                        @endif
                                                        @error('newimage')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror

                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="formFile-1" class="form-label">Images 4+<span
                                                                class="text-danger"> *</span></label>
                                                        <input type="file" class="form-control" id="formFile-1"
                                                            wire:model="newimages" multiple>
                                                        @if ($newimages)
                                                            @foreach ($newimages as $image)
                                                                <img src="{{ $image->temporaryUrl() }}"
                                                                    width="120" />
                                                            @endforeach
                                                        @else
                                                            @foreach ($images as $image)
                                                                @if ($image)
                                                                    <img src="{{ asset('admin/product') }}/{{ $image }}"
                                                                        width="120" />
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        @error('newimages')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror


                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Meta Tag<span class="text-danger">
                                                                *</span></label>
                                                        <input type="text" placeholder="Meta Tag"
                                                            class="form-control" wire:model="meta_keywords" />
                                                        @error('meta_keywords')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Meta Description<span
                                                                class="text-danger"> *</span></label>
                                                        <div class="input-group input-group--sa-slug">
                                                            <textarea placeholder="Meta Description" class="form-control mt-3" rows="2" wire:model="meta_description"></textarea>
                                                        </div>
                                                        @error('meta_description')
                                                            <p class="text-danger">{{ $message }} </p>
                                                        @enderror
                                                    </div>

                                                    {{--  <div class="form-group">
                                                        <label class="col-md-4 control-label">Product Attribute</label>
                                                        <div class="col-md-4">
                                                            <select class="form-control" wire:model="attr">
                                                                <option value="0">Select Product Attributes</option>
                                                                @foreach ($attributes as $attribute)
                                                                    <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" class="btn btn-info" wire:click.prevent="add">Add</button>
                                                        </div>
                                                    </div>
                                                    @foreach ($inputs as $key => $value)
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label">{{$attributes->where('id',$attribute_arr[$key])->first()->name}}</label>
                                                            <div class="col-md-4">
                                                                <input type ="text" placeholder="{{$attributes->where('id',$attribute_arr[$key])->first()->name}}" class="form-control input-md" wire:model="attribute_values.{{$value}}" wire:keyup="done"/>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <button type="button" class="btn btn-info" wire:click.prevent="done">Done</button>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <button type="button" class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}},{{$attributes->where('id',$attribute_arr[$key])->first()->id}})">Remove</button>
                                                            </div>
                                                        </div>
                                                    @endforeach --}}
                                                    <div class="col-md-12">

                                                        <div class="card" id="product_attr">
                                                            <div class="card-body" style="padding:15px;">

                                                                @foreach ($productvariant as $key1 => $tdata)
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-md-2 text-center">
                                                                                <label for="size_id"
                                                                                    class="control-label mb-1">
                                                                                    Variant</label>
                                                                                <p>{{ $tdata->variant_detail }}</p>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <label for="sku"
                                                                                    class="control-label mb-1">
                                                                                    SKU</label>
                                                                                <input id="sku" type="text"
                                                                                    class="form-control"
                                                                                    wire:model="skus.{{ $key1 }}"
                                                                                    required
                                                                                    @if ($key1 == 0) readonly @endif>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <label for="mrp"
                                                                                    class="control-label mb-1">
                                                                                    MRP</label>
                                                                                <input id="mrp" name="mrps[]"
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    wire:model="mrps.{{ $key1 }}"
                                                                                    required
                                                                                    @if ($key1 == 0) readonly @endif>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <label for="price"
                                                                                    class="control-label mb-1">
                                                                                    Price</label>
                                                                                <input id="price" name="pris[]"
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    wire:model="pris.{{ $key1 }}"
                                                                                    required
                                                                                    @if ($key1 == 0) readonly @endif>
                                                                            </div>

                                                                            <div class="col-md-2">
                                                                                <label for="qty"
                                                                                    class="control-label mb-1">
                                                                                    Qty</label>
                                                                                <input id="qty" name="qtyes[]"
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    wire:model="qtyes.{{ $key1 }}"
                                                                                    readonly>
                                                                            </div>

                                                                            @if ($key1 == 0)
                                                                            @else
                                                                                <div class="col-md-2">
                                                                                    <label for="qty"
                                                                                        class="control-label mb-1">Add
                                                                                        New Qty</label>
                                                                                    <input id="qty"
                                                                                        name="newqtyes[]"
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        wire:model="newqtyes.{{ $key1 }}">
                                                                                </div>
                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>





                                                    <div class="mb-4 text-center">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>

                                                </div>

                                            </div>
                                        </form>
                                        @if (Session::has('message'))
                                            <div class="alert alert-success" role="alert">
                                                {{ Session::get('message') }}</div>
                                        @endif
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



<!-- sa-app__body / end -->
<!-- sa-app__footer -->

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#additional_info'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('additional_info', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('description', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#manufacturer_details'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('manufacturer_details', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
