<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    function CategorySearch($slug, Request $request)
    {

        $search = '';
        $min_price = strip_tags($request->min_price);
        $max_price = strip_tags($request->max_price);
        $category = Catagory::where('slug', $slug)->select('id', 'catagory_name')->first();
        $categories = Catagory::select('slug', 'catagory_name')->get();
        
        if ($request->ajax()) {
            $Products = Product::with('Attribute', 'Catagory:id,catagory_name,slug')
                ->where('catagory_id', $category->id)
                ->where('status', 1)
                ->latest()->paginate(1);
            $view = view('frontend.search.pagination-data', compact('Products'))->render();
            return response()->json(['html' => $view,]);
        }
        if ($min_price != '') {
            $request->validate([
                'min_price' => ['required', 'integer'],
                'max_price' => ['required', 'integer'],
            ]);
            $Products = DB::table('products')->join('attributes', 'products.id', '=', 'product_id')
                ->join('catagories', 'products.catagory_id', '=', 'catagories.id')
                ->whereBetween('attributes.regular_price', [$min_price, $max_price])
                ->where('products.catagory_id', $category->id)
                ->where('products.status', 1)
                ->latest('products.id')->get();
            return view('frontend.search.category-filter', [
                'Products' => $Products,
                'Categories' => $categories,
                'category' => $category,
                'search' => $search,
            ]);
        }
        $Products = Product::with('Attribute', 'Catagory:id,catagory_name,slug')
            ->where('catagory_id', $category->id)
            ->where('status', 1)
            ->latest()->simplepaginate(1);
        return view('frontend.search.search-data', [
            'Products' => $Products,
            'Categories' => $categories,
            'category' => $category,
            'search' => $search,
        ]);
    }
}
