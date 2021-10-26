<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;

    protected $table = 'styles';

    protected $fillable = ['category_id','style_name'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function products(){
        return $this->hasMany(Products::class);
    }
}
