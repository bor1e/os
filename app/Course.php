<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /* not needed so far:
    public function participants()
    {
      return $this->hasMany('App\Participant');
    }
    */

    public function users()
    {
      return $this->hasManyThrough(
        'App\User',
        'App\Participant',
        'course_id', //model Participant
        'id', //model User
        'id', //model Course
        'user_id' //model Participant
      )->get();
    }


    public function teacher()
    {
      $teacher = $this->hasOne('App\Teacher')->first();
      $user = User::find($teacher->user_id);
      $fullname = '';
      if (isset($teacher->title)) {
        $fullname = $teacher->title.' '.$user->last_name.', '.$user->first_name;
      }
      else {
        $fullname = $user->last_name.', '.$user->first_name;
      }
      
      return [
        'first_name' => $user->first_name,
        'last_name' => $user->last_name,
        'email' => $user->email,
        'city' => $teacher->city,
        'social' => $teacher->social,
        'fullname' => $fullname,
      ];
    }

}
