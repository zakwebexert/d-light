<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $table = 'order_item';

    protected $fillable = ['order_id','product_id','quantity','product_choices'];

    public function order(){
        return $this->belongsTo(OrderDetail::class,'order_id');
    }
    public function product(){
        return $this->belongsTo(Products::class,'product_Id');
    }
}
