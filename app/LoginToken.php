<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class LoginToken extends Model
{
	protected $fillable = ['alumnus_id','token'];

	public function getRouteKeyName()
    {
    	//sets the standard login field to token instead of the default id
        return 'token'; // static::where('token', {wildcard});
    }

	public static function generateFor(Alumnus $alumnus)
	{
		// generate a key for an alumnus
		return static::create([
			'alumnus_id' => $alumnus->id,
			'token' => str_random(50)
		]);
	}

	public function send()
	{
		$email = $this->alumnus->email;
		$firstname  = $this->alumnus->firstname;
		$from = 'Windesheim Support';
		$token = $this->token;
		// send an email to an alumnus with a acces link. Mail located in mail.mail view
		Mail::send('mail.mail',['email' => $this->alumnus->email,'from' => 'Windesheim Support','token' => $this->token,'firstname' => $firstname], function($m) use($email, $from, $token){
    		$m->from('no-reply@windesheim.nl','Windesheim');
    		$m->to($email,$from)->subject('Windesheim alumni login');
    	});
	}



    public function alumnus()
    {
    	return $this->belongsTo(Alumnus::class);
    }
}
