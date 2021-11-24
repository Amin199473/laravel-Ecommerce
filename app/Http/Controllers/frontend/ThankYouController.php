<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThankYouController extends Controller
{
    public function index()
    {
        if (!session()->has('success')) {
            return redirect('/');
        }
        return view('frontend.thankyou.index');
    }
}
