<?php

namespace App;

use App\Participant;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function participants()
    {
      return $this->hasMany('App\Participant');
    }


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


    public function teacherId()
    {
      return $this->belongsTo('App\Teacher', 'id', 'course_id')->first();
    }

    public function teacher()
    {
      return User::find($this->teacherId()->id);
    }

    public function addParticipant($participant)
    {

        $this->participants()->create($participant);
    }

}
