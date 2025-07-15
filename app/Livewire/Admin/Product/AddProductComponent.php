<?php

namespace App\Livewire\Admin\Product;

use App\Models\AttributeValue;
use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\MedType;
use App\Models\Attribute;
use App\Models\AttributeValue2;
use App\Models\Tax; 
use App\Models\Brand;
use App\Models\Breed;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Carbon\Carbon; 
use App\Models\Flavour;

class AddProductComponent extends Component
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
    public $breed_id = [];
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
    public $attribute_values =[];
     public $meta_keywords;
    public $meta_description; 

    // public $attribute_valuesf =[];
    public $para=[];

    public $skus=[];
    public $mrps=[];
    public $pris=[];
    public $qtyes=[];
    public $bulkqtys=[];
    public $bulkrates=[];
    public $flavour_id;
    public $veg;

    public function mount()
    {
        $this->stock_status = 'instock';
        $this->featured = 0;                                                                        
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
        $this->slug = Str::slug($this->name,'-');
    }

    public function tablepara($attribute_valuesf)
    {
        $number = sizeof($attribute_valuesf); 

        $keysvalue = array_keys($attribute_valuesf);
        //dd($number,$keysvalue);
        foreach($keysvalue as $kvalue)
        {
            $size[$kvalue] =  explode(",",$attribute_valuesf[$kvalue]);
        }
        //dd($size[$kvalue]);
        if($number == 0){
            $para =[];
            return $para;
        }
        elseif($number == 1){
            foreach($size[$keysvalue[0]] as $namefd)
            {
                if(trim($namefd," ") != null){
                $para[] = $namefd;
                }
            }
            return $para;
        }else{
        
            foreach($size[$keysvalue[0]] as $namesd)
            {
                foreach($size[$keysvalue[1]] as $namefd)
                {
                    if(trim($namefd," ") != null){
                    $para[] = $namesd.','.$namefd;
                    }
                }
            }
            
            for($y=2;$y<$number;$y++)
            {
                    $l=0;
                    foreach($para as $namepd)
                    {
                        foreach($size[$keysvalue[$y]] as $namerd)
                        {
                            $para[$l] = $namepd.','.$namerd;
                            $l++;
                        }
                    }
            }
            return $para;
        }
    }

    public function add()
    {
        if(!in_array($this->attr,$this->attribute_arr))
        {
            array_push($this->inputs,$this->attr);
            array_push($this->attribute_arr,$this->attr);
           
        }
        //return;
        //dd($this->attribute_arr, $this->attr);
    }
    public function done()
    {
        //dd($this->attribute_values);trim($str," ")
        $this->para =$this->tablepara($this->attribute_values);
        
            $this->skus[0] = $this->SKU;
            $this->mrps[0] = $this->regular_price;
            $this->pris[0] = $this->sale_price;
            $this->qtyes[0] = $this->quantity;       
    }
    public function remove($attr,$value)
    {
        unset($this->inputs[$attr]);
        unset($this->attribute_values[$value]);
        $this->para =$this->tablepara($this->attribute_values);
    }
    
    
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required|unique:products',
            'additional_info'=>'required',
            'description'=>'required',
            'regular_price'=>'required|numeric',
            'sale_price'=>'numeric',
           
            'SKU'=>'required',
            'stock_status'=>'required',
            'featured'=>'required',
            'quantity'=>'required|numeric',
            'image'=>'required|mimes:jpeg,jpg,png',
            'images'=>'required',
            'category_id'=>'required',
            'scategory_id'=>'required',
            'brand_id'=>'required',
            'breed_id'=>'required',
            'hsn_code' =>'required',
            'tax_id' =>'required',
            'freecancellation' =>'required' 
        ]);
    }

    public function render()
    {
        $categories=Category::where('status','!=',3)->get();
        $scategories = SubCategory::where('category_id',$this->category_id)->where('status','!=',3)->get();
        $subcategories = SubSubCategory::where('sub_category_id',$this->s_id)->where('status','!=',3)->get();
        $attributes = Attribute::where('status','!=',3)->get();
        $brands = Brand::where('status','!=',3)->get();
        $taxs = Tax::where('status','!=',3)->where('status',1)->get();
      
        return view('livewire.admin.product.add-product-component',['subcategories' =>$subcategories,'categories'=>$categories,'scategories'=>$scategories,'attributes'=>$attributes,'brands'=>$brands,'taxs'=>$taxs
        ])->layout('layouts.admin');
    }

    public function addProduct()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:products',
            'additional_info'=>'required',
            'description'=>'required',
            'regular_price'=>'required|numeric',
            'sale_price'=>'numeric',
           // 'bulk_quantity'=>'required|numeric',
            //'bulk_rate'=>'required|numeric',
            'SKU'=>'required',
            'stock_status'=>'required',
            'featured'=>'required',
            'quantity'=>'required|numeric',
            'image'=>'required|mimes:jpeg,jpg,png',
            'images'=>'required',
            'category_id'=>'required',
            'scategory_id'=>'required',
            'brand_id'=>'required',
            //'prescription'=>'required',
            'hsn_code' =>'required',
            'tax_id' =>'required',
            'freecancellation' =>'required'
        ],[
            'tax_id.required'=>'The tax slab field is required.',
            'freecancellation.required'=>'The free delivery field is required.',
            'category_id.required'=>'The category field is required.',
            'scategory_id.required'=>'The sub-category field is required.',
            'brand_id.required'=>'The brand field is required.',
            'image.required'=>'The thumbnail image field is required.',
            'images.required'=>'The images field is required.',
            ]);

        $product =new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description =  $this->additional_info;
        $product->description = $this->description;
        $product->manufacturer_details = $this->manufacturer_details;
        $product->regular_price= $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->SKU;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;
        $imageName= Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('product/feat',$imageName);
        $product->image = $imageName;

        if($this->images)
        {
            $imagesname = '';
            foreach($this->images as $key=>$image)
            {
                $imgName = Carbon::now()->timestamp. $key.'.'.$image->extension();
                $image->storeAs('product',$imgName);
                $imagesname = $imagesname.','.$imgName;
            }
            $product->images = $imagesname;
        }
        $product->category_id= $this->category_id;
        if($this->scategory_id)
        {
            $product->subcategory_id = $this->scategory_id;
        }
        $product->subsubcategory_id = $this->sbcategory_id;
        $product->brand_id = $this->brand_id;
       
        $product->tax_id = $this->tax_id;
        $product->freecancellation = $this->freecancellation;
        $product->discount_value = round((($this->regular_price - $this->sale_price)/$this->regular_price)*100, 2);
        $product->hsn_code = $this->hsn_code;
        $product->meta_tag = $this->meta_keywords;
        $product->meta_description = $this->meta_description;
        $product->status = '1';
        $product->add_by = '1'; //Auth::user()->id;
        $product->save();

        foreach($this->attribute_values as $key=>$attribute_value)
        {
            $avalues = explode(",",$attribute_value);
            foreach($avalues as $avalue)
            {
                $attr_value = new AttributeValue();
                $attr_value->attribute_id = $key;
                $attr_value->value = $avalue;
                $attr_value->product_id = $product->id;
                $attr_value->save();
            }
        }
        $j=1;
        foreach($this->para as $key => $tdata)
        {
            if($key == 0){
                $product->variant_detail = $tdata;
                $product->save();
            }
            else{
            $product_varaint = new Product();
            $product_varaint->name = $this->name;
            $product_varaint->slug = $this->slug.'-'.$tdata;
            $product_varaint->short_description =  $this->additional_info;
            $product_varaint->manufacturer_details = $this->manufacturer_details;
            $product_varaint->description = $this->description;
            $product_varaint->regular_price= $this->mrps[$key];;
            $product_varaint->sale_price = $this->pris[$key];
            
            $product_varaint->SKU = $this->skus[$key];
            $product_varaint->stock_status = $this->stock_status;
            $product_varaint->featured = $this->featured;
            $product_varaint->quantity = $this->qtyes[$key];
            $product_varaint->image = $product->image;
            $product_varaint->images = $product->images;
            $product_varaint->category_id= $this->category_id;
            $product_varaint->subcategory_id = $this->scategory_id;
            $product_varaint->subsubcategory_id = $this->sbcategory_id;
            $product_varaint->brand_id = $this->brand_id;
        
            $product_varaint->tax_id = $this->tax_id;
            $product_varaint->freecancellation = $this->freecancellation;
            $product_varaint->discount_value = round((($this->mrps[$key] - $this->pris[$key])/$this->mrps[$key])*100, 2);
            $product_varaint->hsn_code = $this->hsn_code;
            $product_varaint->meta_tag = $this->meta_keywords;
            $product_varaint->meta_description = $this->meta_description;
           
            $product_varaint->status = '1';
            $product_varaint->add_by = '1'; //Auth::user()->id;
            $product_varaint->variant_detail = $tdata;
            $product_varaint->parent_id = $product->id;
            $product_varaint->save();
            }
        }
        
        //dd($this->attribute_values);
        //$fgh =$this->tablepara($this->attribute_values);
        Session()->flash('message','Product has been Created Successfully!');
        //session()->put('varinat',$fgh);
    }
    public function breedseletc()
    {
        // dd($this->disease_id);
    }
}