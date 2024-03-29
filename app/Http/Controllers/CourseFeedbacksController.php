<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseFeedback;
use Illuminate\Http\Request;

class CourseFeedbacksController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:addFeedback')->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $channel, Course $course)
    {
      $this->validate(request(), ['body' => 'required']);
      // TODO: this method should be not used on Course, but on participants,
      // so that only participants should be able to leave feedback

        $course->addFeedback([
          'body' => $request['body'],
          'course_id' => $course,
          'user_id' => auth()->id(),
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CourseFeedback  $courseFeedback
     * @return \Illuminate\Http\Response
     */
    public function show(CourseFeedback $courseFeedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CourseFeedback  $courseFeedback
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseFeedback $courseFeedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CourseFeedback  $courseFeedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseFeedback $courseFeedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CourseFeedback  $courseFeedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseFeedback $courseFeedback)
    {
        //
    }
}
