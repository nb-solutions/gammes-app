<?php

namespace App;

use App\Gamme\Items;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $guarded = [];
	public function item()
	{
		return $this->hasOne(Items::class,'id','item_id');
	}
    public function auteur()
    {
    	return $this->hasOne(User::class,'id','user_id');
    }
}
