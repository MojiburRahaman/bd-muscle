<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::latest('id')->simplepaginate(10);
        // $blogs = Blog::latest()->simplepaginate(2);
        return view('backend.blogs.index', [
            'blogs' => $blogs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return 'hello';
        return view('backend.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //    return $request->blog_description;

        $request->validate([
            'title' => ['required', 'string', 'unique:blogs,title'],
            'meta_description' => ['required'],
            'thumbnail' => ['required', 'image'],
            'blog_image' => ['required', 'image'],
            'blog_description' => ['required'],
        ]);
        // return $request;
        $Blog = new Blog;
        $Blog->title = $request->title;
        $Blog->slug = Str::slug($request->title);
        $Blog->meta_description = $request->meta_description;
        $Blog->blog_description = $request->blog_description;

        if ($request->hasFile('thumbnail')) {
            $blog_thumbnail = $request->file('thumbnail');
            $Blog_thumb_extension = Str::slug($request->title) . '-' . 'thumbnail' . '.' . $blog_thumbnail->getClientOriginalExtension();
            Image::make($blog_thumbnail)->save(public_path('blog/thumbnail/' . $Blog_thumb_extension));
        }
        if ($request->hasFile('blog_image')) {
            $blog_image = $request->file('blog_image');
            $Blog_image_extension = Str::slug($request->title) . '-' . Str::random(3) . '.' . $blog_image->getClientOriginalExtension();
            Image::make($blog_image)->save(public_path('blog/blog_image/' . $Blog_image_extension));
        }
        $Blog->blog_thumbnail = $Blog_thumb_extension;
        $Blog->blog_image = $Blog_image_extension;
        $Blog->save();


        return redirect()->route('blogs.index')->with('success', 'Blog Added Successfully');
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

        return view('backend.blogs.edit', [
            'Blog' => Blog::findorfail($id),
        ]);
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
        // return $request;
        $request->validate([
            'title' => ['required', 'string', 'unique:blogs,title,' . $id],
            'meta_description' => ['required'],
            'thumbnail' => ['nullable', 'image'],
            'blog_image' => ['nullable', 'image'],
            'blog_description' => ['required'],
        ]);
        // return $request;
        $Blog = Blog::findorfail($id);
        $Blog->title = $request->title;
        $Blog->meta_description = $request->meta_description;
        $Blog->blog_description = $request->blog_description;

        if ($request->hasFile('thumbnail')) {
            $blog_thumbnail = $request->file('thumbnail');
            $Blog_thumb_extension = Str::slug($request->title) . '-' . 'thumbnail' . '.' . $blog_thumbnail->getClientOriginalExtension();
            Image::make($blog_thumbnail)->save(public_path('blog/thumbnail/' . $Blog_thumb_extension),100);
            $Blog->blog_thumbnail = $Blog_thumb_extension;
        }
        if ($request->hasFile('blog_image')) {
            $blog_image = $request->file('blog_image');
            $Blog_image_extension = Str::slug($request->title) . '-' . Str::random(3) . '.' . $blog_image->getClientOriginalExtension();
            Image::make($blog_image)->save(public_path('blog/blog_image/' . $Blog_image_extension),100);
            $Blog->blog_image = $Blog_image_extension;
        }

        $Blog->save();
        return redirect()->route('blogs.index')->with('warning', 'Blog Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findorfail($id);
        $thumb = public_path('blog/thumbnail' . $blog->blog_thumbnail);
        $image = public_path('blog/blog_image' . $blog->blog_image);
        if (file_exists($thumb)) {
            unlink($thumb);
        }
        if (file_exists($image)) {
            unlink($image);
        }
        $blog->delete();
        return back()->with('delete', 'Blog Deleted Successfully');
    }
}
