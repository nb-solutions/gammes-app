<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gamme extends Model
{
    protected $guarded = [];

    public function items()
    {
    	return $this->hasMany(Gamme\Items::class);
    }
}
