<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.site-settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function SiteBanner()
    {
        $banners = Banner::latest('id')->get();
        $products = Product::latest('id')->where('status', 1)->get();
        return view('backend.site-settings.banner', [
            'banners' => $banners,
            'products' => $products,
        ]);
    }
    public function SiteBannerPost(Request $request)
    {
        if ($request->product_id != '') {
            $banner = new Banner;
            $banner->product_id = $request->product_id;
            $banner->save();
            return back()->with('success', 'Addedd Successfully');
        }
        if ($request->hasFile('banner_image')) {
            $banner_image = $request->file('banner_image');
            $extension = config('app.name') . '-' . Str::random(6) . '.' . $banner_image->getClientOriginalExtension();
            Image::make($banner_image)->save(public_path('banner_image/' . $extension), 95);
            $banner = new Banner;
            $banner->banner_image = $extension;
            $banner->save();
            return back()->with('success', 'Addedd Successfully');
        }
    }
    public function SiteBannerDelete($id)
    {
        $banner = Banner::findorfail($id);
        $banner_image = $banner->banner_image;
        if ($banner_image != '') {
            $old_banner = public_path('banner_image/' . $banner_image);
            if (file_exists($old_banner)) {
                unlink($old_banner);
            }
            $banner->delete();
            return back()->with('warning', 'Deleted Successfully');
        }
        $banner->delete();
        return back()->with('warning', 'Deleted Successfully');
    }
    public function SiteBannerStatus($id)
    {
        $banner = Banner::findorfail($id);
        $status = $banner->status;
        if ($status == 1) {
            $banner->status = 2;
            $banner->save();
            return back()->with('warning', 'Inactive Successfully');
        }
        $banner->status = 1;
        $banner->save();
        return back()->with('success', 'Active Successfully');
    }
}
