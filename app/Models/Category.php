<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'parent_id', 'model_type'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Each category may have one parent
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Each category may have multiple children
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
