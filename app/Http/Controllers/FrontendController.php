<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Catagory;
use App\Models\Product;
use App\Models\BlogComment;
use App\Models\BlogReply;
use Illuminate\Http\Request;


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
            return response()->json(['html' => $view, 'total' => $Products->count()]);
        }

        if ($search == '') {
            $product = Product::with('Catagory', 'Attribute')
                ->where('status', 1)->latest()
                ->select('id', 'slug', 'catagory_id', 'thumbnail_img', 'product_summary', 'title')
                ->get();
            $blogs = Blog::latest('id')
                ->select('id', 'title', 'slug', 'blog_thumbnail', 'created_at')->take(3)->get();

            return view('frontend.main', [
                'latest_product' => $product,
                'blogs' => $blogs,
            ]);
        }

        $Products = Product::with('Catagory', 'Attribute')
            ->where('title', 'LIKE', "%$search%")
            ->where('status', 1)
            ->select('id', 'slug', 'catagory_id', 'thumbnail_img', 'product_summary', 'title')
            ->latest()->simplePaginate(1);
        $categories = Catagory::select('slug', 'catagory_name')->get();

        return view('frontend.search.category', [
            'Products' => $Products,
            'Categories' => $categories,
            'category' => $category,
            'search' => $search,
        ]);
    }
    function Frontendshop()
    {
        $catagories = Catagory::with('Product.Attribute', 'Product.Catagory')->select('slug', 'id', 'catagory_name',)->latest('id')->get();
        $product = Product::with('Catagory', 'Attribute')->where('status', 1)
            ->select('id', 'slug', 'title', 'thumbnail_img', 'product_summary', 'catagory_id')
            ->latest('id')->simplePaginate(32);
        return view('frontend.pages.shop', [
            'catagories' => $catagories,
            'latest_product' => $product,
        ]);
    }
    function Frontendblog()
    {
        $blogs = Blog::latest('id')->select('id', 'title', 'slug', 'blog_thumbnail', 'blog_description', 'created_at')->paginate(1);
        return view('frontend.pages.blogs', [
            'blogs' => $blogs,
        ]);
    }
    function FrontenblogView($slug)
    {
        $blogs = Blog::latest('id')->select('id', 'title', 'slug', 'blog_thumbnail',  'created_at')->take(5)->get();
        $blog = Blog::where('slug', $slug)->with('BlogComment')->first();
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
            'blog_id' => ['required','numeric'],
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
}
