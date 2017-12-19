<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
  protected $guarded=[];
  
    public function classes()
    {
      return $this->hasMany('App\Course');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id','user_id')->first();
    }
}
