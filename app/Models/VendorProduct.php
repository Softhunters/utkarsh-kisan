<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class VendorProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function productApi(){
        return $this->belongsTo(Product::class, 'product_id')->select('products.id', 'products.name', 'products.slug','products.image','products.regular_price','products.sale_price','products.variant_detail');
    }

    public function vendor(){
        return $this->belongsTo(User::class, 'vendor_id');
    }
}
