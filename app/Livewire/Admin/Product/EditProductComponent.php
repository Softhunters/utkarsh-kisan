<?php

namespace App\Livewire\Admin\Product;

use App\Models\ProductHistory;
use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\MedType;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Tax;
use App\Models\Brand;
use App\Models\Breed;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use App\Models\ProductQuantity;
use App\Models\Flavour;

class EditProductComponent extends Component
{
    use WithFileUPloads;
    public $name;
    public $slug;
    public $additional_info;
    public $description;
    public $manufacturer_details;
    public $regular_price;
    public $sale_price;
    public $bulk_quantity;
    public $bulk_rate;
    public $SKU;
    public $stock_status;
    public $featured;
    public $quantity;
    public $image;
    public $images;
    public $category_id;
    public $scategory_id;
    public $sbcategory_id;
    public $brand_id;
    public $prescription;
    public $hsn_code;
    public $expiry_date;
    public $status;
    public $tax_id;
    public $freecancellation;
    public $s_id;
    public $attr;
    public $inputs = [];
    public $attribute_arr = [];
    public $attribute_values = [];
    public $meta_keywords;
    public $meta_description;

    // public $attribute_valuesf =[];
    public $para = [];

    public $skus = [];
    public $mrps = [];
    public $pris = [];
    public $qtyes = [];
    public $bulkqtys = [];
    public $bulkrates = [];
    public $newimages;
    public $newimage;
    public $product_id;
    public $varaintadata;
    public $newquantity;
    public $newqtyes = [];
    public $productvariant;
    public $flavour_id;
    public $veg;


    public function mount($product_slug)
    {
        $product = Product::where('slug', $product_slug)->first();
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->additional_info = $product->short_description;
        $this->description = $product->description;
        $this->manufacturer_details = $product->manufacturer_details;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;

        $this->SKU = $product->SKU;
        $this->stock_status = $product->stock_status;
        $this->featured = $product->featured;
        $this->quantity = $product->quantity;
        $this->image = $product->image;
        $this->images = explode(",", $product->images);
        //dd($product->images);
        $this->category_id = $product->category_id;
        $this->scategory_id = $product->subcategory_id;
        $this->sbcategory_id = $product->subsubcategory_id;
        // dd($this->sbcategory_id);
        $this->brand_id = $product->brand_id;
        $this->hsn_code = $product->hsn_code;
        $this->tax_id = $product->tax_id;
        $this->freecancellation = $product->freecancellation;
        $this->product_id = $product->id;
        $this->s_id = $this->scategory_id;
        $this->meta_keywords = $product->meta_tag;
        $this->meta_description = $product->meta_description;
        $this->productvariant = Product::where('parent_id', $product->id)->orwhere('id', $product->id)->get();
        // dd( $this->productvariant);
        foreach ($this->productvariant as $key => $tdata) {
            $this->skus[$key] = $tdata->SKU;
            $this->mrps[$key] = $tdata->regular_price;
            $this->pris[$key] = $tdata->sale_price;
            $this->qtyes[$key] = $tdata->quantity;

        }
        // dd($this->skus);
        //    $this->productvariant = Product::where('parent_id', $product->id)->get();

    }
    public function changeSubcategory()
    {
        $this->scategory_id = 0;
    }

    public function changeSubSubcategory()
    {
        $this->s_id = $this->scategory_id;
        $this->sbcategory_id = 0;
    }
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'additional_info' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',

            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required|numeric',
            // 'image'=>'required|mimes:jpeg,jpg,png',
            //'images'=>'required',
            'category_id' => 'required',
            'scategory_id' => 'required',
            'brand_id' => 'required',
            // 'hsn_code' =>'required',
            'tax_id' => 'required',
            'freecancellation' => 'required',
            'slug' => 'required|unique:products,slug,' . $this->product_id . '',
        ]);
        if ($this->newimage) {
            $this->validateOnly($fields, [
                'newimage' => 'required|mimes:jpeg,jpg,png',
            ]);
        }
        if ($this->newquantity) {
            $this->validateOnly($fields, [
                'newquantity' => 'required|numeric',
            ]);
        }
    }

    public function updateProduct()
    {
        //dd((($this->regular_price - $this->sale_price)/$this->regular_price)*100);
        //dd($this->newqtyes);
        $this->validate([
            'name' => 'required',
            'additional_info' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            // 'quantity' => 'required|numeric',
            // 'image'=>'required|mimes:jpeg,jpg,png',
            //'images'=>'required',
            'category_id' => 'required',
            'scategory_id' => 'required',
            'brand_id' => 'required',
            // 'hsn_code' =>'required',
            'tax_id' => 'required',
            'freecancellation' => 'required',
            'slug' => 'required|unique:products,slug,' . $this->product_id . '',
        ]);

        if ($this->newimage) {
            $this->validate([
                'newimage' => 'required|mimes:jpeg,jpg,png',
            ]);
        }
        if ($this->newquantity) {
            $this->validate([
                'newquantity' => 'required|numeric',
            ]);
        }

        $product = Product::find($this->product_id);
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->additional_info;
        $product->description = $this->description;
        $product->manufacturer_details = $this->manufacturer_details;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->SKU;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        // $product->quantity = $this->quantity + $this->newquantity;

        if ($this->newquantity) {
            $product->quantity += $this->newquantity;

            ProductHistory::create([
                'seller_id' => '1',
                'product_id' => $product->id,
                'type' => 'add',
                'quantity' => $this->newquantity,
            ]);
        }
        // if($this->newimage){
        //     unlink('admin/product/feat'.'/'.$product->image);
        //     $imageName= Carbon::now()->timestamp.'.'.$this->newimage->extension();
        //     $this->newimage->storeAs('product/feat',$imageName);
        //     $product->image = $imageName;
        // }
        // if($this->newimages)
        // {
        //     if($product->images)
        //     {
        //         $images = explode(",",$product->images);
        //         foreach($images as $image)
        //         {
        //             if($image)
        //             {
        //                 unlink('admin/product'.'/'.$image);
        //             }
        //         }
        //     }
        //     $imagesname = '';
        //     foreach($this->newimages as $key=>$image)
        //     {
        //         $imgName= Carbon::now()->timestamp.'.'.$image->extension();
        //         $image->storeAs('products',$imgName);
        //         $imagesname = $imagesname.','.$imgName;
        //     }
        //     $product->images = $imagesname;
        // }
        if ($this->newimage) {
            $oldImagePath = public_path('admin/product/feat/' . $product->image);
            if ($product->image && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            // $this->newimage->storeAs('product/feat', $imageName, 'public');
            $this->newimage->storeAs('product/feat', $imageName);
            $product->image = $imageName;
        }

        if ($this->newimages) {
            if ($product->images) {
                $images = explode(",", $product->images);
                foreach ($images as $image) {
                    $oldImagePath = public_path('admin/product/' . $image);
                    if ($image && file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }

            $imagesname = '';
            foreach ($this->newimages as $key => $image) {
                $imgName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs('product', $imgName);
                $imagesname .= ',' . $imgName;
            }
            $product->images = ltrim($imagesname, ',');
        }

        $product->category_id = $this->category_id;
        if ($this->scategory_id) {
            $product->subcategory_id = $this->scategory_id;
        }
        $product->subsubcategory_id = $this->sbcategory_id;
        $product->brand_id = $this->brand_id;

        $product->tax_id = $this->tax_id;
        $product->freecancellation = $this->freecancellation;
        $product->discount_value = round((($this->regular_price - $this->sale_price) / $this->regular_price) * 100, 2);
        $product->hsn_code = $this->hsn_code;
        $product->meta_tag = $this->meta_keywords;
        $product->meta_description = $this->meta_description;
        $product->save();

        // if ($this->newquantity) {
        //     $prqty = new ProductQuantity();
        //     $prqty->product_id = $product->id;
        //     $prqty->quantity = $this->newquantity;
        //     $prqty->save();
        // }


        $j = 1;
        foreach ($this->productvariant as $key => $tdata) {
            if ($key == 0) {

            } else {
                $product_varaint = Product::find($tdata->id);
                $product_varaint->name = $this->name;
                $product_varaint->slug = $this->slug . '-' . $tdata->variant_detail;
                $product_varaint->short_description = $this->additional_info;
                $product_varaint->manufacturer_details = $this->manufacturer_details;
                $product_varaint->description = $this->description;
                $product_varaint->regular_price = $this->mrps[$key];
                ;
                $product_varaint->sale_price = $this->pris[$key];

                $product_varaint->SKU = $this->skus[$key];
                $product_varaint->stock_status = $this->stock_status;
                $product_varaint->featured = $this->featured;
                if (array_key_exists($key, $this->newqtyes)) {
                    $product_varaint->quantity = $this->qtyes[$key] + $this->newqtyes[$key];
                } else {
                    $product_varaint->quantity = $this->qtyes[$key];
                }
                $product_varaint->category_id = $this->category_id;
                $product_varaint->subcategory_id = $this->scategory_id;
                $product_varaint->subsubcategory_id = $this->sbcategory_id;
                $product_varaint->brand_id = $this->brand_id;

                $product_varaint->tax_id = $this->tax_id;
                $product_varaint->freecancellation = $this->freecancellation;
                $product_varaint->discount_value = round((($this->mrps[$key] - $this->pris[$key]) / $this->mrps[$key]) * 100, 2);
                $product_varaint->hsn_code = $this->hsn_code;
                $product_varaint->meta_tag = $this->meta_keywords;
                $product_varaint->meta_description = $this->meta_description;
                $product_varaint->save();


                $j++;
                if (array_key_exists($key, $this->newqtyes)) {
                    $prqty = new ProductQuantity();
                    $prqty->product_id = $product->id;
                    $prqty->product_varaint_id = $product_varaint->id;
                    $prqty->quantity = $this->newqtyes[$key];
                    $prqty->save();
                }
            }




        }

        Session()->flash('message', 'Product has been Updated Successfully!');
        return redirect()->route('admin.products2');
    }

    public function render()
    {
        $categories = Category::where('status', '!=', 3)->get();
        $scategories = SubCategory::where('category_id', $this->category_id)->where('status', '!=', 3)->get();
        $subcategories = SubSubCategory::where('sub_category_id', $this->s_id)->where('status', '!=', 3)->get();
        $attributes = Attribute::where('status', '!=', 3)->get();
        $brands = Brand::where('status', '!=', 3)->get();
        $taxs = Tax::where('status', '!=', 3)->get();
        return view('livewire.admin.product.edit-product-component', [
            'subcategories' => $subcategories,
            'categories' => $categories,
            'scategories' => $scategories,
            'attributes' => $attributes,
            'brands' => $brands,
            'taxs' => $taxs
        ])->layout('layouts.admin');
    }

    public function breedseletc()
    {
        // dd($this->disease_id);
    }
}