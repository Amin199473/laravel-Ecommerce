<?php

namespace App\Models;

use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->take(8);
    }

    public function wishlists()
    {
        return $this->hasMany(WishList::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
