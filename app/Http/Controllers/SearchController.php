<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function CategorySearch($slug)
    {
        // return $slug;
        $category = Catagory::where('slug', $slug)->select('id', 'catagory_name')->first();
        $Products = Product::with('Attribute', 'Catagory:id,catagory_name')->where('catagory_id', $category->id)->latest()->simplepaginate();
        $categories = Catagory::select('slug', 'catagory_name')->get();
        return view('frontend.search.category', [
            'Products' => $Products,
            'Categories' => $categories,
            'category' => $category,
        ]);
    }
}
