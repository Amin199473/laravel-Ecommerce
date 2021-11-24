<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_title',
        'site_description',
        'email',
        'address',
        'phone',
        'youTube',
        'telegram',
        'tweeter',
        'instagram',
        'copy_right',
        'whatsapp'
    ];
}
