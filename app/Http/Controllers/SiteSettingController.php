<?php

namespace App\Http\Controllers;

use App\Models\AboutSite;
use App\Models\Banner;
use App\Models\Product;
use App\Models\SiteSetting;
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
        //    return $request->site_logo;
        $request->validate([
            'meta_title' => ['required', 'string', 'max:250'],
            'meta_description' => ['required', 'string', 'max:250'],
            'meta_keyword' => ['required', 'string', 'max:250'],
            'email' => ['required', 'string', 'max:250'],
            'number' => ['required',],
            'address' => ['required', 'string', 'max:250'],
            'facebook_link' => ['max:250'],
            'instagram_link' => ['max:250'],
            'footer_text' => ['required', 'string'],
            'site_logo' => ['required', 'mimes:png'],
        ]);

        $setting = new SiteSetting;
        $setting->meta_title = $request->meta_title;
        $setting->meta_description = $request->meta_description;
        $setting->meta_keyword = $request->meta_keyword;
        $setting->email = $request->email;
        $setting->number = $request->number;
        $setting->address = $request->address;
        $setting->facebook_link = $request->facebook_link;
        $setting->instagram_link = $request->instagram_link;
        $setting->footer_text = $request->footer_text;

        if ($request->hasFile('site_logo')) {
            $site_logo = $request->file('site_logo');
            $extension = config('app.name') . '-' . Str::random(2) . '.' . $site_logo->getClientOriginalExtension();
            Image::make($site_logo)->save(public_path('logo/' . $extension), 100);
            $setting->site_logo = $extension;
        }
        $setting->save();

        return back()->with('success', 'Addedd Successfully');


        return $request;
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
    public function edit($id, Request $request)
    {
        abort_if(!$request->hasValidSignature(), 404);
        $setting = SiteSetting::findorfail($id);
        return view('backend.site-settings.edit', compact('setting'));
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
        $request->validate([
            'meta_title' => ['required', 'string', 'max:250'],
            'meta_description' => ['required', 'string', 'max:250'],
            'meta_keyword' => ['required', 'string', 'max:250'],
            'email' => ['required', 'string', 'max:250'],
            'number' => ['required',],
            'address' => ['required', 'string', 'max:250'],
            'facebook_link' => ['max:250'],
            'instagram_link' => ['max:250'],
            'footer_text' => ['required', 'string'],
            'site_logo' => ['mimes:png'],
        ]);

        $setting = SiteSetting::findorfail($id);
        $setting->meta_title = $request->meta_title;
        $setting->meta_description = $request->meta_description;
        $setting->meta_keyword = $request->meta_keyword;
        $setting->email = $request->email;
        $setting->number = $request->number;
        $setting->address = $request->address;
        $setting->facebook_link = $request->facebook_link;
        $setting->instagram_link = $request->instagram_link;
        $setting->footer_text = $request->footer_text;

        if ($request->hasFile('site_logo')) {
            $old_thumbnail = public_path('logo/' . $setting->site_logo);
            if (file_exists($old_thumbnail)) {
                unlink($old_thumbnail);
            }
            $site_logo = $request->file('site_logo');
            $extension = config('app.name') . '-' . Str::random(2) . '.' . $site_logo->getClientOriginalExtension();
            Image::make($site_logo)->save(public_path('logo/' . $extension), 100);
            $setting->site_logo = $extension;
        }
        $setting->save();

        return back()->with('success', 'Edited Successfully');
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
    public function SiteAbout($id, Request $request)
    {
        abort_if(!$request->hasValidSignature(), 404);
        $about = AboutSite::findorfail($id);
        return view('backend.site-settings.about', compact('about'));
    }
    public function SiteAboutUpdate(Request $request)
    {
        $request->validate([
            'heading' => ['required', 'max:250', 'string'],
            'about' => ['required'],
            'about_id' => ['required'],
        ]);
        $about = AboutSite::findorfail($request->about_id);
        $about->heading = $request->heading;
        $about->about = $request->about;
        $about->save();
        return back()->with('success', 'Edited Successfully');
    }
}
