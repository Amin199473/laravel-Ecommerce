<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $orders = Order::all();
        $posts = Post::where('status', 'published')->get();
        $products = Product::all();
        return view('admin.index', compact('users', 'orders', 'posts', 'products'));
    }
}
