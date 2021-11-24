<?php

namespace App\Http\Controllers\frontend;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\SalesDate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        $timerSales = SalesDate::first();
        $mightAlsoLike  = Product::mightAlsoLike()->get();
        return view('frontend.cart.index', compact('mightAlsoLike', 'timerSales'));
    }

    //add item to shoppin cart
    public function store(AddToCartRequest $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->options->color === $request->color && $cartItem->options->size === $request->size && $cartItem->id === $request->id;
        });
        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success', 'Item already exist!');
        }
        if ($request->has('sales')) {
            Cart::add($request->id, $request->name, 1, $request->sales, ['color' => $request->color, 'size' => $request->size])
                ->associate('App\Models\Product');
        } else {
            Cart::add($request->id, $request->name, 1, $request->price, ['color' => $request->color, 'size' => $request->size])
                ->associate('App\Models\Product');
        }

        return redirect()->route('cart.index')->with('success', 'Items was added your Cart!');
    }

    public function update(Request $request, $id)
    {
        Cart::update($id, $request->quantity);
        session()->flash('success', 'Qauntity was updated successfully');
        return response()->json(['success' => true]);
    }

    //remove item from shopping cart
    public function destroy($id)
    {
        Cart::remove($id);

        return redirect()->back()->with('success', 'item removed Successfully');
    }

    public function switchToSaveForLater($id)
    {

        $item = Cart::get($id);
        Cart::remove($id);
        $duplicates = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success', 'Item already saved for later!');
        }
        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price, ['color' => $item->options->color, 'size' => $item->options->size])
            ->associate('App\Models\Product');

        return redirect()->route('cart.index')->with('success', 'Items has save for later!');
    }
}