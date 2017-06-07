<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'group';
    public function alumnus()
    {
    	return $this->belongsToMany(Alumnus::class);
    }
    public function collection()
    {
    	return $this->belongsTo(Collection::class);
    }
    public function user()
    {
    	return $this->belongsToMany(User::class)->withTimestamps();
    }
}
