<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'address',
        'state',
        'city',
        'country',
        'pin_code',
        'id_proof_type',
        'proof_image',
        'gstin_number',
        'gstin_image',
        'status',
        'package_id',
        'is_active'
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function stateDetail()
    {
        return $this->belongsTo(State::class, 'state');
    }
    public function countryDetail()
    {
        return $this->belongsTo(Country::class, 'country');
    }
    public function cityDetail()
    {
        return $this->belongsTo(City::class, 'city');
    }
}
