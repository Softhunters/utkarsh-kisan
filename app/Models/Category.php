<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class,'category_id')->where('status',1);
    }

    public function productcount()
    {
        return $this->hasMany(Product::class,'category_id')->where('status',1);
    }
}
