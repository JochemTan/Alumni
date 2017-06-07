<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class Alumnus extends Authenticatable
{
    protected $table = 'alumnus';
    public function setting()
    {
    	return $this->hasOne(Setting::class);
    }
    public function group()
    {
    	return $this->belongsToMany(Group::class);
    }
    public function company()
    {
    	return $this->belongsTo(Company::class);
    }

    public static function byEmail($email)
    {
        return static::where('email',$email)->firstOrFail();
    }
//    $name
    public function fullName()
    {
        return $this->name();
    }
    public function name()
    {
        //set all names in one variable.
        $name = $this->firstname . " " . $this->insertion . " " . $this->lastname;
        //replace multiple spaces into one space.
        $fullname = preg_replace('!\s+!', ' ', $name);
        //return string.
        return $fullname;
    }
    public function dateToYear()
    {
        // parse string to carbon.
        $convertDate = Carbon::parse($this->birthday);

        //check difference between birthday and date of today.
        $age = $convertDate->diff(Carbon::now());
        // return value
        return $age->y;
    }
}
