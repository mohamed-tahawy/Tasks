<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VarintValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'option_id',
        'variant_id',
        'variant_value_name',
        'variant_value',
    ];
}
