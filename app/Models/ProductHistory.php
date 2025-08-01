<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function seller(){
        return $this->belongsTo(User::class, 'seller_id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function orderItem(){
        return $this->belongsTo(OrderItem::class, 'order_id');
    }
}
