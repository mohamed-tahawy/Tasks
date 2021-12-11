<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_name', 'description'];

    // relation has many 
    public function varians()
    {
        return $this->hasMany(Variant::class,'product_id','id');
    }
    public function productOption()
    {
        return $this->hasMany(Product_Option::class,'product_id','id');
    }

}
