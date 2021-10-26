<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_choices extends Model
{
    use HasFactory;
    protected $table = 'product_choices';

    protected $fillable = ['product_id','choice_title','description'];

    public function product(){
        return $this->belongsTo(Products::class,'product_id');
    }

    public function options(){
        return $this->hasMany(choice_options::class,'choice_id');
    }
}
