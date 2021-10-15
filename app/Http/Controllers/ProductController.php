<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Catagory;
use App\Models\Color;
use App\Models\Flavour;
use App\Models\Product;
use App\Models\Size;
use App\Models\Gallery;
use App\Models\Subcatagory;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {$products = Product::latest('id')->simplepaginate();
        return view('backend.product.index',[
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catagories = Catagory::select('id', 'catagory_name')->latest('id')->get();
        $colors = Color::select('id', 'color_name')->get();
        $sizes = Size::select('id', 'size_name')->get();
        $brands = Brand::select('id', 'brand_name')->latest('id')->get();
        return view('backend.product.create', [
            'catagories' => $catagories,
            'colors' => $colors,
            'sizes' => $sizes,
            'brands' => $brands,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'product_name' => ['required', 'string', 'max:250',],
            'catagory_name' => ['required'],
            'subcatagory_name' => ['required'],
            'thumbnail_img' => ['required', 'mimes:png,jpeg,jpg', 'dimensions:max_width=300,max_height=300'],
            'product_img' => ['required'],
            'product_summary' => ['required'],
            'product_description' => ['required'],
            // 'quantity[]' => ['required'],
            // 'regular_price[]' => ['required'],
        ], [
            // 'quantity[].required' => 'Quantitiy Field is required',
            // 'regular_price[].required' => 'Regular Price is required'
        ]);

        $product = new Product;
        $product->title = $request->product_name;
        $product->slug = Str::slug($request->product_name);
        $product->catagory_id = $request->catagory_name;
        $product->subcatagory_id = $request->subcatagory_name;
        $product->product_summary = $request->product_summary;
        $product->product_description = $request->product_description;

        if ($request->hasFile('thumbnail_img')) {
            $product_thumbnail = $request->file('thumbnail_img');
            $extension = Str::slug($request->product_name) . '-' . Str::random(1) . '.' . $product_thumbnail->getClientOriginalExtension();
            Image::make($product_thumbnail)->save(public_path('thumbnail_img/' . $extension), 70);
        }
        $product->thumbnail_img = $extension;
        $product->save();



        if ($request->hasFile('product_img')) {
            // product image validation
            $p_img = $request->file('product_img');
            foreach ($p_img as $value) {
                $product_img = Str::slug($request->product_name) . '-' . Str::random(2) . '.' .
                    $value->getClientOriginalExtension();

                Image::make($value)->save(public_path('product_image/' . $product_img), 70);
                $gallery = new Gallery;
                $gallery->product_img = $product_img;
                $gallery->product_id = $product->id;
                $gallery->save();
            }
        }
        foreach ($request->flavour_name as $flavour) {
            if ($flavour != '') {
                $flavours = new Flavour;
                $flavours->product_id = 1;
                $flavours->flavour_name = $flavour;
                $flavours->save();
            }
        }


        foreach ($request->color_id as $key => $color_id) {
            $attribute = new Attribute;
            $attribute->product_id = $product->id;
            $attribute->color_id = $color_id;
            $attribute->size_id = $request->size_id[$key];
            $attribute->quantity = $request->quantity[$key];
            $attribute->regular_price = $request->regular_price[$key];
            $attribute->sell_price = $request->selling_price[$key];
            $attribute->brand_id = $request->brand_id[$key];
            $attribute->save();
        }

        return redirect()->route('product.index')->with('success', 'Product Added Successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function GetSubcatbyAjax($cat_id)
    {
        $subcatagories  = Subcatagory::select('id', 'subcatagory_name')->where('catagory_id', $cat_id)->latest('id')->get();
        return response()->json($subcatagories);
    }
}
