<?php

namespace App\Http\Controllers;

use App\Models\Order_Summaries;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order =Order_Summaries::get();
        $product =Product::where('status',1)->count();
        $user = Role::where('name','Customer')->count();
       return view('backend.main',[
           'order'=> $order,
           'product'=> $product,
           'user'=> $user,
       ]);
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
    public function AdminChangePassword(){
        return view('backend.change-password');
    }
    public function AdminChangePasswordPost(Request $request){
        $request->validate([
            'current_pass' => ['required', 'min:8'],
            'new_pass' => ['required', 'min:8'],
            'confirm_pass' => ['required', 'same:new_pass', 'min:8'],
        ], [
            'current_pass.min' => 'Current Password must be minimum 8 Charecter',
            'current_pass.required' => 'Current Password field required',
            'new_pass.required' => 'New Password field required',
            'new_pass.min' => 'New Password must be minimum 8 Charecter',
            'confirm_pass.min' => 'Confirm Password must be minimum 8 Charecter',
            'confirm_pass.min' => 'Confirm Password must be minimum 8 Charecter',
        ]);

        $current_pass = strip_tags($request->current_pass);
        $new_pass = strip_tags($request->new_pass);
        $confirm_pass = strip_tags($request->confirm_pass);
        $user = auth()->user();

        if (Hash::check($current_pass, $user->password)) {
            $user->update([
                'password' => bcrypt($new_pass),
            ]);
            return back()->with('success', 'Password Updated Successfully');
        } else {

            return back()->with('warning', 'Password not matched');
        }
    }
}
