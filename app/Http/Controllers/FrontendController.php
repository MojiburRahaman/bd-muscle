<?php

namespace App\Http\Controllers;

use App\Models\AboutSite;
use App\Models\Banner;
use App\Models\BestDeal;
use App\Models\Blog;
use App\Models\Catagory;
use App\Models\Product;
use App\Models\BlogComment;
use App\Models\BlogReply;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{
    function Frontendhome(Request $request)
    {
        $category = '';
        $search = strip_tags($request->search);

        if ($request->ajax()) {
            $Products = Product::with('Catagory', 'Attribute')
                ->where('title', 'LIKE', "%$search%")
                ->where('status', 1)
                ->select('id', 'slug', 'catagory_id', 'thumbnail_img', 'product_summary', 'title')
                ->latest()->simplePaginate(1);

            $view = view('frontend.search.pagination-data', compact('Products'))->render();
            return response()->json(['html' => $view,]);
        }

        if ($search == '') {
            $deal = BestDeal::where('status', 1)->first();
            $banners = Banner::latest('id')
                ->with(['Product:id,title,slug,thumbnail_img', 'Product.Attribute:id,product_id,discount,regular_price'])
                ->where('status', 1)->get();

            $best_seller = Product::with('Catagory:id,slug,catagory_name', 'Attribute:product_id,discount,regular_price,sell_price')->where('most_view', '!=', 0)
                ->where('status', 1)->orderBy('most_view', 'DESC')
                ->select('id', 'most_view', 'slug', 'catagory_id', 'thumbnail_img', 'product_summary', 'title')
                ->withCount('ProductReview')
                ->take(4)
                ->get();

            $product = Product::with('Catagory', 'Attribute:product_id,discount,regular_price,sell_price')
                ->where('status', 1)->latest('id')
                ->select('id', 'slug', 'catagory_id', 'thumbnail_img', 'product_summary', 'title')
                ->withCount('ProductReview')
                ->take(8)
                ->get();

            $blogs = Blog::latest('id')
                ->select('id', 'title', 'add_to_goal', 'slug', 'blog_thumbnail', 'created_at')
                ->where('add_to_goal', 1)
                ->withCount('BlogComment')->take(3)->get();

            return view('frontend.main', [
                'latest_product' => $product,
                'blogs' => $blogs,
                'best_seller' => $best_seller,
                'banners' => $banners,
                'deal' => $deal,
            ]);
        }
        $Products = Product::with('Catagory', 'Attribute')
            ->where('title', 'LIKE', "%$search%")
            ->where('status', 1)
            ->select('id', 'slug', 'catagory_id', 'thumbnail_img', 'product_summary', 'title')
            ->latest()->simplePaginate(1);
        $categories = Catagory::select('slug', 'catagory_name')->get();

        return view('frontend.search.search-data', [
            'Products' => $Products,
            'Categories' => $categories,
            'category' => $category,
            'search' => $search,
        ]);
    }
    function Frontendshop(Request $request)
    {
        if ($request->ajax()) {
            $Products = Product::with('Catagory', 'Attribute')->where('status', 1)
                ->select('id', 'slug', 'title', 'thumbnail_img', 'product_summary', 'catagory_id')
                ->latest('id')->simplePaginate(16);

            $view = view('frontend.pages.shop-pagination-data', compact('Products'))->render();
            return response()->json(['html' => $view,]);
        }

        $catagories = Catagory::with('Product.Attribute', 'Product.Catagory')->select('slug', 'id', 'catagory_name',)->latest('id')->get();
        $product = Product::with('Catagory', 'Attribute')->where('status', 1)
            ->select('id', 'slug', 'title', 'thumbnail_img', 'product_summary', 'catagory_id')
            ->latest('id')->simplePaginate(16);
        return view('frontend.pages.shop', [
            'catagories' => $catagories,
            'latest_product' => $product,
        ]);
    }
    function Frontendblog()
    {
        $blogs = Blog::latest('id')->select('id', 'title', 'slug', 'blog_thumbnail', 'blog_description', 'created_at')->paginate(15);
        return view('frontend.pages.blogs', [
            'blogs' => $blogs,
        ]);
    }
    function FrontenblogView($slug)
    {
        $blogs = Blog::latest('id')->select('id', 'title', 'slug', 'blog_thumbnail',  'created_at')->take(5)->get();
        $blog = Blog::where('slug', $slug)->with('BlogComment')->withCount('BlogComment')->first();
        $next = Blog::where('id', '>', $blog->id)->select('slug')->first();
        return view('frontend.pages.blog-view', [
            'blog' => $blog,
            'blogs' => $blogs,
            'next' => $next,
        ]);
    }
    function BlogComment(Request $request)
    {
        $request->validate([

            'user_name' => ['required', 'max:250'],
            'email' => ['required', 'email'],
            'subject' => ['nullable', 'string'],
            'comment' => ['required'],
            'blog_id' => ['required', 'numeric'],
        ]);

        $user_name =  strip_tags($request->user_name);
        $email =  strip_tags($request->email);
        $subject =  strip_tags($request->subject);
        $comment =  strip_tags($request->comment);
        $blog_id =  strip_tags($request->blog_id);

        $blog_comment = new BlogComment;
        $blog_comment->email = $email;
        $blog_comment->user_name = $user_name;
        $blog_comment->subject = $subject;
        $blog_comment->comment = $comment;
        $blog_comment->blog_id = $blog_id;
        $blog_comment->save();
        return back();
    }
    function BlogReply(Request $request)
    {
        $request->validate([
            'blogcomment_id' => ['required',],
            'reply' => ['required'],
            'blog_id' => ['required'],

        ]);

        $user_id =  auth()->id();
        $reply =  strip_tags($request->reply);
        $blogcomment_id =  strip_tags($request->blogcomment_id);
        $blog_id =  strip_tags($request->blog_id);


        $blog_comment = new BlogReply;
        $blog_comment->user_id = $user_id;
        $blog_comment->blogcomment_id = $blogcomment_id;
        $blog_comment->reply = $reply;
        $blog_comment->blog_id = $blog_id;
        $blog_comment->save();
        return back();
    }
    function FrontendNewsLetter(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:newsletters,email']
        ]);

        $email = strip_tags($request->email);
        $newsletter = new Newsletter;
        $newsletter->email = $email;
        $newsletter->save();
        return back()->with('subscribe', 'Subscribe Successfully');
    }
    function FrontendCertified()
    {
        $products = Product::where('certified', 1)->where('status', 1)->latest('id')->paginate(16);
        return view('frontend.pages.certifed', compact('products'));
    }
    function FrontendAbout()
    {
        $best_seller = Product::with('Catagory:id,slug,catagory_name', 'Attribute:product_id,discount,regular_price,sell_price')->where('most_view', '!=', 0)
            ->where('status', 1)->orderBy('most_view', 'DESC')
            ->select('id', 'most_view', 'slug', 'catagory_id', 'thumbnail_img', 'product_summary', 'title')
            ->take(8)
            ->get();
        $about = AboutSite::first();
        return view('frontend.pages.about', compact('about', 'best_seller'));
    }
}
