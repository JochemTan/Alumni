<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AuthenticatesUser;
use App\Http\Requests;
use App\LoginToken;
use Auth;


class AlumnusAuthController extends Controller
{
    protected $redirectTo = '/alumnus/login';
    protected $guard = 'alumnus';

    public function __construct()
    {
        $this->middleware('alumnus',['only' => 'index']);
    }

    public function index()
    {
        return view('alumnus.home');
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
        // \Session::flash('success','An email has been send to '.$request->email);
        \Session::flash('alert','An email has been send to '.$request->email);
    	return back();
    }
    public function authenticate(AuthenticatesUser $auth, LoginToken $token)
    {
        $auth->login($token);
        return redirect('alumnus');
    }
    public function logout()
    {
        // Auth::guard('alumnus')->logout();
        // Auth::guard('alumnus')->logout();
        Auth::guard('alumnus')->logout();
        return redirect('/alumnus/login');
    } 
}
