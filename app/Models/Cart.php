<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function sellerProduct()
    {
        return $this->belongsTo(VendorProduct::class, 'product_id', 'product_id')->whereColumn('vendor_products.vendor_id', 'carts.seller_id');
    }
}
