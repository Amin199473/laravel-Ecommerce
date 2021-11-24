<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        $user_id = auth()->user()->id;
        $wishlist = new WishList();
        $wishlist->user_id = $user_id;
        $wishlist->product_id = $request->product_id;
        $wishlist->save();
        return redirect()->back()->with('success', 'product added to wishlist!');
    }

    public function removeFromWishlist(Request $request, $id)
    {
        $wishlist = WishList::find($id);
        $wishlist->delete();
        return redirect()->back()->with('success', 'product removed from wishlist!');
    }
}
