<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewAndRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addReview(Request $request, $id)
    {

        $request->validate([
            'rating' => 'required',
            'comment' => 'required|min:3',
        ]);
        $orders = Auth::user()->orders;
        foreach ($orders as $order) {
            $order_items = OrderItem::where('order_id', $order->id)->where('product_id', $id)->withTrashed()->get();
            foreach ($order_items as $item) {
                $item->review_status = true;
                $item->save();
            }
        }
        $review = new Review();
        $review->rating = $request->rating;
        $review->user_id = Auth::user()->id;
        $review->product_id = $id;
        $review->comment = $request->comment;
        $review->order_item_id = $item->id;
        $review->save();
        return redirect()->back()->with('success', 'you review added Successfully');
    }
}