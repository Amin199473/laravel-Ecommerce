<?php

namespace App\Http\Controllers\frontend;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\SalesDate;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->take(6)->get();
        $testimonials = Testimonial::all();
        $timerSales = SalesDate::first();
        $sliders = Slider::where('status', 1)->get();
        $categories = Category::where('model_type', 'App\Models\Product')->get();
        $products = Product::latest()->take(8)->get();
        $randomProducts = Product::inRandomOrder()->take(8)->get();
        return view('welcome', compact('products', 'categories', 'randomProducts', 'sliders', 'timerSales', 'testimonials', 'posts'));
    }

    public function products()
    {
        $minPrice = Product::get()->min('price');
        $maxPrice = Product::get()->max('price');
        $getSales = Product::whereNotNull('sales')->whereNotIn('status', ['Draft'])->get();
        $products = Product::whereNotIn('status', ['Draft'])->paginate(6);
        $categories = Category::where('model_type', 'App\Models\Product')->get();
        $brands = Brand::all();
        $timerSales = SalesDate::first();
        return view('frontend.products.products', compact('categories', 'brands', 'products', 'getSales', 'timerSales', 'minPrice', 'maxPrice', 'minPrice', 'maxPrice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category($id)
    {
        $minPrice = Product::get()->min('price');
        $maxPrice = Product::get()->max('price');
        //find All Products Based Their Category
        $products = Product::where('category_id', $id)->paginate(6);
        $categoryName = Category::where('id', $id)->first();
        $categories = Category::where('model_type', 'App\Models\Product')->get();
        $brands = Brand::all();
        $getSales = Product::whereNotNull('sales')->whereNotIn('status', ['Draft'])->get();
        $timerSales = SalesDate::first();
        return view('frontend.products.category-products', compact('products', 'categoryName', 'categories', 'brands', 'getSales', 'timerSales', 'minPrice', 'maxPrice'));
    }

    public function brand($id)
    {
        $minPrice = Product::get()->min('price');
        $maxPrice = Product::get()->max('price');
        //find All Products Based Their brand
        $timerSales = SalesDate::first();
        $products = Product::where('brand_id', $id)->paginate(6);
        $brandName = Brand::where('id', $id)->first();
        $categories = Category::where('model_type', 'App\Models\Product')->get();
        $brands = Brand::all();
        $getSales = Product::whereNotNull('sales')->whereNotIn('status', ['Draft'])->get();
        return view('frontend.products.brand-products', compact('products', 'brandName', 'categories', 'brands', 'getSales', 'timerSales', 'minPrice', 'maxPrice'));
    }


    public function onSales()
    {
        $minPrice = Product::get()->min('price');
        $maxPrice = Product::get()->max('price');
        $timerSales = SalesDate::first();
        $getSales = Product::whereNotNull('sales')->whereNotIn('status', ['Draft'])->get();
        $onSales = Product::whereNotNull('sales')->whereNotIn('status', ['Draft'])->paginate(6);
        $categories = Category::where('model_type', 'App\Models\Product')->get();
        $brands = Brand::all();
        return view('frontend.products.onSales', compact('onSales', 'categories', 'brands', 'getSales', 'timerSales', 'minPrice', 'maxPrice'));
    }

    public function filterByPrice(Request $request)
    {
        $minPrice = Product::get()->min('price');
        $maxPrice = Product::get()->max('price');
        $timerSales = SalesDate::first();
        $getSales = Product::whereNotNull('sales')->whereNotIn('status', ['Draft'])->get();
        $categories = Category::where('model_type', 'App\Models\Product')->get();
        $brands = Brand::all();
        $min = str_replace('$', '', $request->minPrice);
        $max = str_replace('$', '', $request->maxPrice);
        $timerSales = SalesDate::where('status', 1)->first();
        if (!$timerSales) {
            $products = Product::whereBetween('sales', [$min, $max])->paginate(6);
        } else {
            $products = Product::whereBetween('price', [$min, $max])->paginate(6);
        }
        return view('frontend.products.filterByPrice', compact('products', 'categories', 'brands', 'getSales', 'timerSales', 'minPrice', 'maxPrice'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $user_id = isset($user) ? $user->id : '';
        $orderItem = OrderItem::where('user_id', $user_id)->where('product_id', $id)->withTrashed()->first();
        $product = Product::find($id);
        $avgRating = $product->reviews->avg('rating');
        $timerSales = SalesDate::first();
        $product = Product::where('id', $id)->firstOrFail();
        $mightAlsoLike = Product::where('id', '!=', $id)->mightAlsoLike()->get();
        return view('frontend.products.single-product', compact('product', 'mightAlsoLike', 'timerSales', 'avgRating', 'orderItem'));
    }
}