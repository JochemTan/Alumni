<?php

namespace App\Http\Controllers\alumnusAuth;
use App\AuthenticatesUser; 
use App\Http\Requests;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    public function __construct()
    {
        
    }
    public function login()
    {
        return view('alumnus.login');
    }
    public function postLogin(AuthenticatesUser $auth, Request $request)
    {
        // sends an email to the user with the token link
        $auth->invite();
        // make this into flash to session 
        \Session::flash('success','An email has been send to '.$request->email);
        return back();
    }

}
