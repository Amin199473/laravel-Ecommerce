<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['option_name', 'option_value'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
