<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','insertion','lastname','jobTitle', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $table = 'users';

    public function collection()
    {
        return $this->belongsToMany(Collection::class);
    }
    public function group()
    {
        return $this->belongsToMany(Group::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function getRole()
    {
        return $this->role()->get()[0];
    }
//    public function fullName()
//    {
//        return $this->name();
//    }
    public function name()
    {
        //set all names in one variable.
        $name = $this->firstname . " " . $this->insertion . " " . $this->lastname;
        //replace multiple spaces into one space.
        $fullname = preg_replace('!\s+!', ' ', $name);
        //return string.
        return $fullname;
    }
    public function fullname($id)
    {
        // find the user with the given id
        $user = User::find($id);
        //check if user has insertion
        //set all names in one variable.
        $name = $user->firstname . " " . $user->insertion . " " . $user->lastname;
        //replace multiple spaces into one space.
        $fullname = preg_replace('!\s+!', ' ', $name);
        //return string.
        return $fullname;
    }
}
