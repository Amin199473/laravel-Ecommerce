<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::get();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {

        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $filename = 'image' . '_' . time() . '.' . $photo->getClientOriginalExtension();
            $location = public_path('slider-image/');
            $request->file('image')->move($location, $filename);
        }
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->image = $filename;
        $slider->button = $request->button;
        $slider->link_button = $request->link;
        $slider->status = $request->status;
        $slider->save();

        return redirect()->back()->with('success', 'You add one slider');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('admin.slider.update', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        if ($request->hasFile('image')) {
            //unlink old Images in public path
            $path = 'slider-image/' . $slider->image;
            $path = public_path($path);
            if (file_exists($path)) {
                unlink($path);
            }
            $photo = $request->file('image');
            $filename = 'image' . '_' . time() . '.' . $photo->getClientOriginalExtension();
            $location = public_path('slider-image/');
            $request->file('image')->move($location, $filename);
        }

        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->image = isset($filename) ? $filename : $slider->image;
        $slider->button = $request->button;
        $slider->link_button = $request->link;
        $slider->status = $request->status;
        $slider->save();

        return redirect()->back()->with('success', 'You Updated one slider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();

        return redirect()->back()->with('success', 'Slider Deleted Successfuly');
    }

    public function deleteAll()
    {
        $sliders = Slider::get();
        if (!$sliders->isEmpty()) {
            foreach ($sliders as $slider) {
                $slider->delete();
            }
            return redirect()->back()->with('success', 'All Sliders deleted succesfully');
        } else {
            return redirect()->back()->with('failed', 'There is none Slider for delete');
        }
    }
}