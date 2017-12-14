<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseFeedback extends Model
{
    public function user()
    {
      $this->belongsTo('App\User', 'user_id');
    }

    public function course()
    {
      $this->belongsTo('App\Course', 'course_id');
    }
}
