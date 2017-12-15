<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseFeedback extends Model
{
  protected $guarded = [];

    public function user()
    {
      return $this->belongsTo('App\User')->first();
    }

    public function course()
    {
      return $this->belongsTo('App\Course')->first();
    }  
}
