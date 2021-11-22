<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    
    function FrontendProfile(){
        return view('frontend.Profile.customer-profile');

    }
}
