<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDate extends Model
{
    use HasFactory;
    protected $fillable = ['status', 'sale_date'];
    public $table = 'sales_dates';
}
