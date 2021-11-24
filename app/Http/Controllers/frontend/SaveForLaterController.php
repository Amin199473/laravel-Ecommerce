<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class SaveForLaterController extends Controller
{
    public function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);

        return redirect()->back()->with('success', 'item removed Successfully');
    }

    public function switchToCart($id)
    {
        $item = Cart::instance('saveForLater')->get($id);


        Cart::instance('saveForLater')->remove($id);

        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($item) {

            return $cartItem->options->color === $item->options->color && $cartItem->options->size ===  $item->options->size && $cartItem->id == $item->id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success', 'Item already is Your Cart!');
        }

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price, ['color' => $item->options->color, 'size' => $item->options->size])
            ->associate('App\Models\Product');
        // dd($item->options);
        return redirect()->route('cart.index')->with('success', 'Items has moved to cart!');
    }
}
