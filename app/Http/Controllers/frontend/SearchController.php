<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchProduct(Request $request)
    {
        $keyword = $request->get('keyword');
        $product = Product::where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('title', 'LIKE', '%' . $keyword . '%')
            ->get();

        return response()->json($product);
    }

    public function searchPost(Request $request)
    {
        $keyword = $request->get('keyword');
        $post = Post::where('title', 'LIKE', '%' . $keyword . '%')->get();

        return response()->json($post);
    }
}
