<?php

namespace App;

use App\Events\UserHasRegistered;
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
        'first_name', 'last_name', 'gender', 'email', 'password', 'jewish', 'email_verification_token'
    ];

    /**
     *  The event map for the model.
     *
     *  @var array
     */
     protected $dispatchesEvents = [
        'created' => UserHasRegistered::class,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    /**
     * Assign the given role to the user.
     *
     * @param  string $role
     * @return mixed
     */
    public function assignRole($role)
    {
            //dd($this->roles()->get());
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }
    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return !! $role->intersect($this->roles)->count();
    }

    public function revokeRole($role)
    {
        //if ($this->hasRole($role)) {
        return $this->roles()->detach(
            Role::whereName($role)->firstOrFail()
        );
        //}
    }

    /**
     * Determine if the user may perform the given permission.
     *
     * @param  Permission $permission
     * @return boolean
     */
    public function hasPermission(Permission $permission)
    {
        return $this->hasRole($permission->roles);
    }

    public function participates()
    {
      return $this->belongsToMany('App\Course','participants');
    }

    /**
     *  Get the email verification url.
     *
     *  @return string
     */

    public function email_verification_token()
    {
      return [
        'email_verification_token' => str_random(60),
      ];
    }

    public function verifyEmail()
    {
        $this->email_verification_token = null;
        $this->save();

        return $this;
    }

    public function getEmailVerificationUrlAttribute()
    {
        return route('verify_email', ['token' => $this->email_verification_token]);
    }
    /*
    select `courses`.*, `participants`.`a`
    from `courses`
    inner join `participants` on `participants`.`d` = `courses`.`b`
    where `participants`.`a` is null)

    */
    /*'course_id', //model Participant
    'id', //model User
    'id', //model Course
    'user_id' //model Participant*/
}
