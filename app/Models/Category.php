<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "product_category";

    protected $fillable = ["name"];

    public function styles(){
        return $this->hasMany(Style::class);
    }

    public function product(){
        return $this->hasMany(Products::class,'category_id');
    }
}
