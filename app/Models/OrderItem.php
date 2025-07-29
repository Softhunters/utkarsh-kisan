<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = "orderitems";

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function orderApi()
    {
        return $this->belongsTo(Order::class, 'order_id')->select([
            'id',
            'name',
            'mobile',
            'line1',
            'line2',
            'landmark',
            'country_id',
            'state_id',
            'city_id',
            'zipcode',
            'status',
            'order_number',
            'delivered_date',
            'canceled_date',
            'created_at'
        ]);
    }


    public function productApi()
    {
        return $this->belongsTo(Product::class, 'product_id')->select('products.id', 'products.name', 'products.slug', 'products.image', 'products.regular_price', 'products.sale_price', 'products.variant_detail');
    }
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id')->select('users.id', 'users.name');
    }
    public function sellerMail()
    {
        return $this->belongsTo(User::class, 'seller_id')->select('users.id', 'users.name', 'users.email');
    }
}
