<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageContent extends Model
{
    use HasFactory;

    protected $table = "home_page_content";

    protected $fillable = ["jsondata",'comment'];

    public function products(){
        return $this->belongsTo(Products::class,'product_id');
    }

}
