<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }
    
    public function product(){
    	return $this->belongsTo(Product::class,'product_id','id');
    }
}
