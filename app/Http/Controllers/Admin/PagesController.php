<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function aboutUs()
    {
        $aboutus = AboutUs::first();
        return view('admin.pages.about-us', compact('aboutus'));
    }

    public function aboutUsStore(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $aboutUs = AboutUs::first();
        if ($aboutUs == null) {
            $aboutUs = new AboutUs();
            $aboutUs->description = $request->description;
            $aboutUs->save();
            return redirect()->back()->with('success', 'Content Page Created Successfully!');
        } else {
            $aboutUs->update([
                'description' => $request->description,
            ]);
            return redirect()->back()->with('success', 'Content Page Updated Successfully!');
        }
    }


    public function privacyPolicy()
    {
        $privacyPolicy = PrivacyPolicy::first();

        return view('admin.pages.privacy&policy', compact('privacyPolicy'));
    }


    public function privacyPolicyStore(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);
        $privacyPolicy = PrivacyPolicy::first();
        if ($privacyPolicy == null) {
            $privacyPolicy = new PrivacyPolicy();
            $privacyPolicy->description = $request->description;
            $privacyPolicy->save();
            return redirect()->back()->with('success', 'Content Page Created Successfully!');
        } else {
            $privacyPolicy->update([
                'description' => $request->description,
            ]);
            return redirect()->back()->with('success', 'Content Page Updated Successfully!');
        }
    }
}