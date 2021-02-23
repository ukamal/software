<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function supplier(){
    	return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
    public function unit(){
    	return $this->belongsTo(Units::class,'unit_id','id');
    }
    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }
    public function product(){
    	return $this->belongsTo(Product::class,'product_id','id');
    }
}
