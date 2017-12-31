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


    public function owner()
    {
      return $this->belongsTo('App\Teacher','id' ,'course_id');
    }

    public function hasTeacher()
    {
        return count($this->owner()->first());
    }

    public function teacher()
    {
      return User::find($this->owner()->first()->id)->first();
    }

    public function addParticipant($participant)
    {
        return $this->participants()->create($participant);
    }

    public function link()
    {
        return 'https://global.gotomeeting.com/join/'.$this->g2m_id;
    }

    public function feedbacks()
    {
        return $this->hasMany('App\CourseFeedback');
    }

    // TODO: this method should be not used in Course-Model, but on the
    // participant-Model so that only participants sould be
    // able to leave feedback
    public function addFeedback($feedback)
    {
        $this->feedbacks()->create($feedback);
    }

    public function path()
    {
        return '/courses/' . $this->id;
    }
}
