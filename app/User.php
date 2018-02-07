<?php

namespace App;

use App\Events\UserHasRegistered;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'gender', 'email', 'password', 'profile_id', 'email_verification_token'
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
        'password', 'remember_token','email_verification_token'
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
        return $this->roles()->detach(
            Role::whereName($role)->firstOrFail()
        );
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

    public function profile()
    {
        return $this->hasOne(Profile::class, 'id', 'profile_id');
    }

    public function verifyEmail()
    {
        $this->email_verification_token = null;
        $this->save();
        $this->assignRole('email_confirmed');
        return $this;
    }

    public function getEmailVerificationUrl()
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
