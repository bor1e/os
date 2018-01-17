<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
    
    public function owner()
    {
      if($this->type=='user')
        return $this->belongsTo(User::class, 'id', 'profile_id');

      return $this->belongsTo(Teacher::class, 'id', 'profile_id');
    }
}
