<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable=['first_name','last_name','email','salary', 'gender', 'slug', 'profile_id'];

    public function getRouteKeyName()
    {
      return 'slug';
    }

    public function courses()
    {
      return $this->hasMany(Course::class);
    }

    public function participants()
    {
      return $this->hasManyThrough('App\Participant', 'App\Course');
    }

    public function profile()
    {
      return $this->hasOne(Profile::class, 'id', 'profile_id');
    }

    public function path()
    {
      return '/teacher/'.$this->slug;
    }
}
