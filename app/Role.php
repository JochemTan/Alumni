<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table = 'role';
    public function employee()
    {
    	return $this->hasMany(Employee::class);
    }
}
