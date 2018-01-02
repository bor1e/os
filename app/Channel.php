<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['name'];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
