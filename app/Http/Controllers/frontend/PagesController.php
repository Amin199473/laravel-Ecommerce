<?php

namespace App\Http\Controllers\frontend;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function aboutUs()
    {
        $aboutus = AboutUs::first();
        return view('frontend.pages.about-us', compact('aboutus'));
    }

    public function privacyPolicy()
    {
        $privacyPolicy = PrivacyPolicy::first();
        return  view('frontend.pages.privacy&policy', compact('privacyPolicy'));
    }
}
