<?php
namespace App\Filters;
use App\User;
use App\Teacher;

class CourseFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['by'];
    /**
     * Filter the query by a given username.
     *
     * @param  string $username
     * @return Builder
     */
    protected function by($username)
    {
        #dd($username);
        $teacher = Teacher::where('last_name', $username)->firstOrFail();
        //FIXME
        return $this->builder->where('teacher_id', $teacher->id);
    }
}
