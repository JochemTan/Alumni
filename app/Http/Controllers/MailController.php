<?php

namespace App\Http\Controllers;
use Mail;
use App\Alumnus;
use App\LoginToken;
use App\Http\Requests;
use Illuminate\Http\Request;


class MailController extends Controller
{
    public function mailing(Request $request)
    {
    	
    	$alumnus = Alumnus::all();
    	dd($alumnus);
    }

    public function send()
    {
    	$alumni = Alumnus::all();
        foreach ($alumni as $alumnus) {
            // $logintoken = new LoginToken;
            // $logintoken->alumnus_id = $alumnus->id;
            // $logintoken->token = str_random(50);
            // $logintoken->save(); 
        
    		$email = $alumnus->email;
    		Mail::queue('mail.year', ['email' => $alumnus->email], function ($message) use ($email) {
    		$message->from('no-reply@windesheim.nl','Controleer je gegevens');
    		$message->to($email,'someone')->subject('Controleer je gegevens');
		});
        }
    }
}
