<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class,'city_id')->orderBy('name','ASC');
    }
    public function state()
    {
        return $this->belongsTo(State::class,'state_id')->orderBy('name','ASC');
    }
}
