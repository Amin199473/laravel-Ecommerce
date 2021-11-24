<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialsRequest;
use App\Http\Requests\UpdateTestimonialsRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonialsRequest $request)
    {
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $filename = 'image' . '_' . time() . '.' . $photo->getClientOriginalExtension();
            $location = public_path('testimonial-image/');
            $request->file('image')->move($location, $filename);
        }
        $testimonial = new Testimonial();
        $testimonial->customer_name = $request->customer_name;
        $testimonial->description = $request->description;
        $testimonial->image = $filename;
        $testimonial->save();

        return redirect()->back()->with('success', 'Testimonial Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.update', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestimonialsRequest $request, Testimonial $testimonial)
    {
        if ($request->hasFile('image')) {
            //unlink old Images in public path
            $path = 'testimonial-image/' . $testimonial->image;
            $path = public_path($path);
            if (file_exists($path)) {
                unlink($path);
            }
            $photo = $request->file('image');
            $filename = 'image' . '_' . time() . '.' . $photo->getClientOriginalExtension();
            $location = public_path('testimonial-image/');
            $request->file('image')->move($location, $filename);
        }
        $testimonial->customer_name = $request->customer_name;
        $testimonial->description = $request->description;
        $testimonial->image = $filename;
        $testimonial->save();

        return redirect()->back()->with('success', 'testimonial updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->back()->with('success', 'testimonial deleted successfully!');
    }

    public function deleteAll()
    {
        $testimonials = Testimonial::get();
        if (!$testimonials->isEmpty()) {
            foreach ($testimonials as $testimonial) {
                $testimonial->delete();
            }
            return redirect()->back()->with('success', 'All testimonials deleted succesfully!');
        } else {
            return redirect()->back()->with('failed', 'There is none testimonial for delete!');
        }
    }
}
