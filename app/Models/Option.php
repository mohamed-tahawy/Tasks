<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $fillable = ['option_name'];

    public function values()
    {
        return $this->hasMany(Option_Value::class,'option_id','id');
    }
}
