<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';
    
    // public function collection()
    // {
    // 	return $this->belongsToMany(Collection::class);
    // }
    // public function group()
    // {
    // 	return $this->belongsToMany(Group::class);
    // }
    // public function role()
    // {
    // 	return $this->belongsTo(Role::class);
    // }
}
