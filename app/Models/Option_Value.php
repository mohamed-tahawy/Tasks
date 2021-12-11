<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option_Value extends Model
{
    use HasFactory;
    protected $table = 'option__values';
    protected $fillable = ['option_id', 'value_name'];
}
