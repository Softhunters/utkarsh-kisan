<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    public function vendorProducts()
    {
        return $this->hasMany(VendorProduct::class, 'product_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subCategories()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'product_id');
    }

    public function taxslab()
    {
        return $this->belongsTo(Tax::class, 'tax_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id')->where('verified', 1);
    }
    public function questions()
    {
        return $this->hasMany(Question::class, 'product_id');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'product_id')->where('user_id', Auth::user()->id);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id')->where('user_id', Auth::user()->id);
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function seller()
    {
        return $this->hasOne(VendorProduct::class, 'product_id');
    }
    public function sellerAll()
    {
        return $this->hasMany(VendorProduct::class, 'product_id');
    }
}
