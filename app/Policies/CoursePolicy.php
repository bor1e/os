<?php

namespace App\Policies;

use App\User;
use App\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if($user->hasRole('manager')) {
          return true;
        }
    }


    /**
     * Determine whether the user can view the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function view(User $user, Course $course)
    {
        //
    }

    /**
     * Determine whether the user can create courses.
     *
     * @param  \App\User  $user
     * @return mixed
     */

    public function create(User $user)
    {
        return $user->hasRole('teacher');
    }

    /**
     * Determine whether the user can update the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function update(User $user, Course $course)
    {
        return $course->hasTeacher() && $course->owner()->first()->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function delete(User $user, Course $course)
    {
        //
    }
}
