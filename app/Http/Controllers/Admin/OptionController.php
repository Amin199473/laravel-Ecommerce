<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OptionsRequest;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::has('options')->get();
        return view('admin.option.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.option.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OptionsRequest $request)
    {
        $listOption_values = explode(',', $request->option_value);
        $option = new Option();
        $option->option_name = $request->option_name;
        $option->option_value = serialize($listOption_values);
        $option->product_id = $request->product_id;
        $option->save();
        return redirect()->back()->with('success', 'Option add successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        $products = Product::all();
        return view('admin.option.update', compact('option', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(OptionsRequest $request, Option $option)
    {

        $listOption_values = explode(',', $request->option_values);
        $option->option_name = $request->option_name;
        $option->option_value = serialize($listOption_values);
        $option->product_id = $request->product_id;
        $option->save();

        return redirect()->back()->with('success', 'option Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        $option->delete();
        return redirect()->back()->with('success', 'options deleted succesfully');
    }

    public function deleteAll()
    {
        $options = Option::get();
        if (!$options->isEmpty()) {
            foreach ($options as $option) {
                $option->delete();
            }
            return redirect()->back()->with('success', 'All options deleted succesfully');
        } else {
            return redirect()->back()->with('failed', 'There is none options for delete');
        }
    }
}