<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'quser_id');
    }
    // public function answers()
    // {
    //     return $this->hasMany(Answer::class,'question_id')->where('verified',1);
    // }
}
