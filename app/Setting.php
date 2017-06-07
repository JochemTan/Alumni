<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $table = 'settings';
    public function alumnus()
    {
    	return $this->hasOne(Alumnus::class);
    }
}
