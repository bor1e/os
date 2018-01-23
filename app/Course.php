<?php

namespace App;

use App\Participant;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];
    protected $dates = ['date'];
    protected $dateFormat = 'd.m.Y';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /*
     * Get the route key name for Laravel.
     *
     * @return string

    public function getRouteKeyName()
    {
        return 'slug';
    }
     */

    public function channel()
    {
        return  $this->belongsTo(Channel::class);
    }

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
      );

    }

    public function teacher()
    {
      return $this->belongsTo(Teacher::class);
    }

    public function hasTeacher()
    {
        return count($this->teacher()->first());
    }

    public function addParticipant($participant)
    {
        return $this->participants()->create($participant);
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
        return "/courses/{$this->channel->name}/{$this->slug}";
    }
}
