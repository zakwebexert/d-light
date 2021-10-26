<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class choice_options extends Model
{
    use HasFactory;
    protected $table = 'choice_options';

    protected $fillable = ['choice_id','option_title','description'];

    public function choice(){
        return $this->belongsTo(product_choices::class,'product_i');
    }
}
