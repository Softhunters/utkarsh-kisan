<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Brand;
use App\Models\Breed;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Category;
use Livewire\WithPagination;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Flavour;

class CategorySearchComponent extends Component
{
    use WithPagination;
    public $sorting;
    public $pagesize;
    public $min_price;
    public $max_price;
    
    public $category_slug;
    public $scategory_slug;
    public $brandtype=[];
    public $breedtype=[];
    public $discount =[];
    public $cartp=[];
    public $wishp=[];
    public $max,$min;
    public $flavourtype =[];
    
    
    public function mount($category_slug,$scategory_slug=null)
    {
        $this->sorting="default";
        $this->pagesize="12";
        $this->category_slug = $category_slug;
       $this->min =Product::where('status',1)->min('regular_price');
        $this->max =Product::where('status',1)->max('regular_price');
        $this->min_price =$this->min;
        $this->max_price=$this->max;
        $this->scategory_slug = $scategory_slug;
    }

    public function render(Request $request)
    {
        $category_id = null;
        $category_name = "";
        $filter= "";
        $category = "";
        $scategory = [];
        $scategory_id =null;
        $scategory_name="";
        
        if(Auth::check())
        {
            // $this->cartp = Cart::where('user_id', Auth::user()->id)->pluck('product_id')->toArray();
            // $this->wishp = Wishlist::where('user_id', Auth::user()->id)->pluck('product_id')->toArray(); 
        }else{
             if (Session::has('cart')){
                $cartlist = $request->session()->get('cart');
                $this->cartp = array_keys($cartlist);
             }
             if (Session::has('wishlist')){
                $wish = $request->session()->get('wishlist');
                $this->wishp = array_keys($wish);
            }
        }
        
        if($this->scategory_slug)
        {
            $scategory = Subcategory::where('slug',$this->scategory_slug)->first();
            $scategory_id = $scategory->id;
            $scategory_name = $scategory->name;
            $filter= "sub";
        }
        if($this->category_slug){
            $category=Category::where('slug',$this->category_slug)->first();
            $category_id= $category->id;
            $category_name =$category->name;
            $filter= "";
        }
        $query = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->where('status',1)->whereNull('parent_id');
        if($this->category_slug){
            $query=$query->where('category_id',$category->id);
        }
        if($this->scategory_slug){
            $query=$query->where('subcategory_id',$scategory->id);
        }
       if($this->sorting=="date"){
        $query=$query->orderBy('created_at','DESC');
       }
       if($this->sorting=="price"){
        $query=$query->orderBy('regular_price','ASC');
       }
       if($this->sorting=="price-desc"){
        $query=$query->orderBy('regular_price','DESC');
       }
       if($this->brandtype != null)
       {
        $query=$query->whereIn('brand_id',$this->brandtype);
       }
       if($this->breedtype != null)
       {
        $query=$query->whereIn('breed_id',$this->breedtype);
       }
       if($this->discount != null)
       {
        $query=$query->where('discount_value','>=', (int) min($this->discount));
       }
         if($this->flavourtype != null)
       {
        $query=$query->whereIn('flavour_id',$this->flavourtype);
       }
        $query=$query->distinct()->select('products.*');
        $products=$query->paginate($this->pagesize);

        $categorys = Subcategory::where('category_id',$category_id)->where('status',1)->get();
        $brands = Brand::where('status',1)->get();
      
//  dd($categorys);
        return view('livewire.frontend.category-search-component',['categorys'=>$categorys,'brands'=>$brands,
        'category_name'=>$category_name,'scategory'=>$scategory,'CATegory'=>$category,'products'=>$products])->layout('layouts.main');
    }

    public function brandseletc()
    {
       // dd($this->brandtype);
    }
    public function breedseletc()
    {
       // dd($this->brandtype);
    }
     public function flavourselect()
    {
       // dd($this->brandtype);
    }
    public function addToWishlist(Request $request,$product_id,$product_price)
    {
        $id= $product_id;
        if(Auth::check())
        {
            $wproduct = Wishlist::where('product_id',$product_id)->where('user_id',Auth::user()->id)->first();
            if($wproduct){
                session()->flash('info','Item alreday added to wishlist');;
                return;
            }else{
                $product = Product::where('id', $product_id)->first();
                $wishlist = new Wishlist();
                $wishlist->user_id = Auth::user()->id;
                $wishlist->product_id = $product_id;
                $wishlist->product_name = $product->name;
                $wishlist->product_image = $product->image;
                $wishlist->price = $product->sale_price;
                $wishlist->quantity = '1';
                $wishlist->save();
                session()->flash('success','Item added to Wishlist!');
                // $this->dispatch('wishlist-count-component');
                $this->dispatch('wishlist_add');
                return;
            }
        }else{
            $product = Product::where('id', $product_id)->first();
            $wishlist = $request->session()->get('wishlist');

                
                    $wishlist[$id] = [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'product_image' => $product->image,
                         'quantity' => '1',
                        'price' => $product->sale_price
                    ];
                    Session()->put('wishlist', $wishlist);
                   
                    session()->flash('success','Item added to Wishlist!');
                $this->dispatch('wishlist_add');

        }
      
        //  $this->dispatch('wishlist-count-component','refreshComponent');
        return;
    }
    
    public function removeFromWishlist(Request $request,$product_id)
    {
        if(Auth::check()){
                $wishlist = Wishlist::where('product_id',$product_id)->where('user_id',Auth::user()->id)->first();
                if($wishlist){
                    $wishlist->delete();
                    session()->flash('warning','Item remove from wishlist!');
                    // $this->dispatch('wishlist-count-component','refreshComponent');
                    $this->dispatch('wishlist_add');
                    return;
                }
        }else{
            if (Session::has('wishlist')){

                $wishlistdf = $request->session()->get('wishlist');
                unset($wishlistdf[$product_id]);
                Session()->put('wishlist', $wishlistdf);
                // dd($wishlistdf);
                session()->flash('warning','Item remove from wishlist!');
                // $this->dispatch('wishlist-count-component','refreshComponent');
                $this->dispatch('wishlist_add');
                return;

            }
        }
        return;
    }
    public function AddtoCart(Request $request,$product_id,$product_price)
    {
        $id= $product_id;
        if(Auth::check())
        {
            $wproduct = Cart::where('product_id',$product_id)->where('user_id',Auth::user()->id)->first();
            if($wproduct){
                session()->flash('info','Item alreday added to Cart!');
                return;
            }else{
                $product = Product::where('id', $product_id)->first();
                // if($this->quntiti >= $product->quantity)
                // {
                //     session()->flash('message','Item Quantity is not perest');
                //     return;
                // }else{
                $cart = new Cart();
                $cart->user_id = Auth::user()->id;
                $cart->product_id = $product_id;
                $cart->product_name = $product->name;
                $cart->product_image = $product->image;
                $cart->price = $product->sale_price;
                $cart->quantity = '1';
                $cart->save();
                session()->flash('success','Item added to cart!');
                // $this->dispatch('wishlist-count-component','refreshComponent');
                $this->dispatch('cart_add');
                return;
                // }
            }
        }else{
            $product = Product::where('id', $product_id)->first();
            $cart = $request->session()->get('cart');

                
                    $cart[$id] = [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'product_image' => $product->image,
                         'quantity' => '1',
                        'price' => $product->sale_price
                    ];
                    Session()->put('cart', $cart);
                   
                    session()->flash('success','Item added to cart!');
                
                $this->dispatch('cart_add');
        }
      
        //  $this->dispatch('wishlist-count-component','refreshComponent');
        return;
    }
}