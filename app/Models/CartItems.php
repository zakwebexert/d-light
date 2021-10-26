<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    use HasFactory;

    protected $table = 'cart_item';
    protected $fillable = ['product_id','user_id','product_choices'];

    public function product(){
        return $this->belongsTo(Products::class,'product_id');
    }
}
