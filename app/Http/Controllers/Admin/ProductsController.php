<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('model_type', 'App\Models\Product')->get();
        $brands = Brand::all();
        return view('admin.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //Validations
        $validated = $request->validated();

        $user_id = auth()->user()->id;
        $product = new Product();
        $product->user_id = $user_id;
        $product->name = $request->name;
        $product->title = $request->title;
        $product->slug = $request->slug;
        if ($request->hasFile('image')) {
            $images = $request->file('image');
            foreach ($images as $key => $image) {
                $destinationPath = 'Images-Product';
                $filename = 'image' . '_' . time() . ++$key . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $filename);
                $data[] = $filename;
            }
        }
        $product->images = json_encode($data);
        $product->main_image = $data[0];
        $product->summary = $request->summary;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->sales = $request->sales;
        $product->featured = $request->featured;
        $product->descriptions = $request->descriptions;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->published_at = $request->published_at;
        $product->save();

        return redirect()->back()->with('success', 'Product created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::where('model_type', 'App\Models\Product')->get();
        $brands = Brand::all();
        return view('admin.product.update', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->user_id = auth()->user()->id;
        $product->name = $request->name;
        $product->title = $request->title;
        $product->slug = $request->slug;
        $images = json_decode($product->images);
        if ($request->has('image')) {
            foreach ($images as $img) {
                //unlink old Images in public path
                $path = 'Images-product/' . $img;
                $path = public_path($path);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $imagesProduct = $request->file('image');
            foreach ($imagesProduct as $key => $image) {
                $destinationPath = 'Images-Product';
                $filename = 'image' . '_' . time() . ++$key . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $filename);
                $data[] = $filename;
            }
        }
        $product->images = isset($data) ? json_encode($data) : $product->images;
        $product->main_image = isset($data) ? $data[0] : $product->main_image;
        $product->summary = $request->summary;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->sales = $request->sales;
        $product->featured = $request->featured;
        $product->descriptions = $request->descriptions;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->published_at = $request->published_at;
        $product->save();

        return redirect()->back()->with('success', 'Product Updated Successfully');
    }

    public function featured(Request $request, $id)
    {
        $product = Product::find($id);
        $product->featured = $request->featured;
        $product->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }

    public function deleteAll()
    {
        $products = Product::get();
        if (!$products->isEmpty()) {
            foreach ($products as $product) {
                $product->delete();
            }
            return redirect()->back()->with('success', 'All Products deleted succesfully');
        } else {
            return redirect()->back()->with('failed', 'There is none Product for delete');
        }
    }
}