<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = "product";

    protected $fillable = ["name","product_desc","SKU","category_id","discount_id","inventory_id","	price",'style_id'];

    public function style(){
        return $this->belongsTo(Style::class);
    }

    public function front_items(){
        return $this->hasMany(HomePageContent::class,'product_id');
    }

    public function choices(){
        return $this->hasMany(product_choices::class,'product_id')->with('options');
    }

    public function cartitems(){
        return $this->hasMany(CartItems::class,'product_id');
    }

    public function wishitems(){
        return $this->hasMany(Wishlist::class,'item_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function images(){
        return $this->hasMany(ProductImage::class,'product_id');
    }
}
