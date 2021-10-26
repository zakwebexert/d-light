<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_detail';

    protected $fillable = ['user_id','total','shiffing_method'];

    public function orderitems(){
        return $this->hasMany(OrderItems::class,'order_id')->with('product');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
