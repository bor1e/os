<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
  protected $guarded=[];

    public function courses($user_id=null)
    {
      if($user_id) {
        $course_ids = Teacher::where('user_id',$user_id)->get()->pluck('course_id')->all();
        return Course::find($course_ids);
      }
      return $this->hasMany(
        'App\Course',
        'id',
        'course_id'
      );
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id','user_id');
    }
}
