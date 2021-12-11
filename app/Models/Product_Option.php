<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Option extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'option_id'];

    // public function option()
    // {
    //     return $this->hasOne(Option::class, 'option_id','id');
    // }

    public function option()
    {
    return $this->belongsTo(Option::class, 'option_id', 'id');
    }


}
