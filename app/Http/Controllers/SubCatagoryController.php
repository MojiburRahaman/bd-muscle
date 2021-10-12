<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use App\Models\Subcatagory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_catagories = Subcatagory::with('Catagory')->select('id', 'catagory_id', 'subcatagory_name', 'created_at')->latest('id')->get();
        return view('backend.subcatagory.index', [
            'subcatagories' => $sub_catagories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catagories = Catagory::select('id', 'catagory_name')->get();

        return view('backend.subcatagory.create', [
            'catagories' => $catagories,

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
        $request->validate([
            'subcatagory_name' => ['required', 'unique:subcatagories,subcatagory_name'],
            'catagory_id' => ['required']
        ]);
        $subcatagory = new Subcatagory;
        $subcatagory->catagory_id = $request->catagory_id;
        $subcatagory->subcatagory_name = strip_tags($request->subcatagory_name);
        $subcatagory->slug = strip_tags(Str::slug($request->subcatagory_name));
        $subcatagory->save();
        return redirect()->route('subcatagory.index')->with('success', 'Sub Catagory Created Successfully');
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
        $subcatagory = Subcatagory::select('id', 'subcatagory_name', 'catagory_id')->findorfail($id);
        $catagories = Catagory::select('id', 'catagory_name')->get();

        return view(
            'backend.subcatagory.edit',
            [
                'catagories' => $catagories,
                'subcatagory' => $subcatagory,
            ]
        );
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
            'subcatagory_name' => ['required', 'unique:subcatagories,subcatagory_name,' . $id],
            'catagory_id' => ['required']
        ]);
        $subcatagory = Subcatagory::findorfail($id);
        $subcatagory->catagory_id = $request->catagory_id;
        $subcatagory->subcatagory_name = strip_tags($request->subcatagory_name);
        $subcatagory->slug = strip_tags(Str::slug($request->subcatagory_name));
        $subcatagory->save();
        return redirect()->route('subcatagory.index')->with('Warning', 'Sub Catagory Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subcatagory::findorfail($id)->delete();
        return back()->with('delete', 'Subcatagory Deleted Successfully');
    }
    public function MarkdeleteSubCatagory(Request $request)
    {
        if ($request->filled('delete')) {
           foreach ($request->delete as $value) {
            Subcatagory::findorfail($value)->delete();
           }
           return back()->with('delete', 'Subcatagory Deleted Successfully');
        } else {
            return back()->with('warning', 'No Item Selected');
        }
    }
}
