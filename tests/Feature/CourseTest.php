<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseTest extends TestCase
{
    /** @test */
    public function a_user_can_view_all_courses()
    {
        $course = factory('App\Course')->create();

        $response = $this->get('/courses');
        $response->assertSee($course->title);
    }

    /** @test */
    public function a_user_can_view_one_course()
    {
        $course = factory('App\Course')->create();

        $response = $this->get('courses/' . $course->id);
        $response->assertSee($course->title);
    }

}
