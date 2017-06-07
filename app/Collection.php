<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
	protected $table = 'collection';
    public function group()
    {
    	return $this->hasMany(Group::class);
    }
    public function employee()
    {
    	return $this->belongsToMany(Employee::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}

