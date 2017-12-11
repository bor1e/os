<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
      return $this->belongsToMany('App\Role');
    }

    public function hasRole($name)
    {
      foreach ($this->roles as $role) {
        if ($role->name == $name) return true;
      }

      return false;
    }

    public function isAdmin()
    {
      foreach ($this->roles as $role) {
        if ($role->name == 'admin') return true;
      }

      return false;
    }

    public function isTeacher()
    {
      foreach ($this->roles as $role) {
        if ($role->name == 'teacher') return true;
      }

      return false;
    }

    public function assignRole($role)
    {
      return $this->roles()->attach($role);
    }

    public function removeRole($role)
    {
      return $this->roles()->detach($role);
    }
}
