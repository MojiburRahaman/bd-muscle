<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {$colors= Color::where('id', '!=' ,1)->select('id','color_name','created_at')->latest()->simplepaginate(10);
        return view('backend.color.index',compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.color.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'color_name' => ['required', 'string', 'max:150','unique:colors,color_name']
        ]);
        $color = new Color;
        $color->color_name = $request->color_name;
        $color->save();
        return redirect()->route('color.index')->with('success', 'Color Added Successfully');
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
        $color= Color::findorfail($id);
      return view('backend.color.edit',compact('color'));
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
            'color_name' => ['required', 'string', 'max:150','unique:colors,color_name,'.$id]
        ]);
        $color =Color::findorfail($id);
        $color->color_name = $request->color_name;
        $color->save();
        return redirect()->route('color.index')->with('warning', 'Color Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Color::findorfail($id)->delete();
        return back()->with('delete', 'Color Deleted Succcessfully');
    }
}
