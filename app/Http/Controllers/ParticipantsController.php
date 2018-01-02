<?php

namespace App\Http\Controllers;

use App\Course;
use App\Participant;
use Illuminate\Http\Request;

class ParticipantsController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:participateInCourse')->only('store');
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
    public function store($channel, Course $course)
    {
//      dd($course);
      $course->addParticipant([
        'course_id' => $course->id,
        'user_id' => auth()->id(),
      ]);

      return back();
        /*
        Participant::create([
          'user_id' =>
          'course_id' =>
        ]);
        return view('/courses/'.course_id, compact('courses'));
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel, Course $course)
    {
        Participant::where('user_id','=',auth()->id())->where('course_id','=',$course->id)->delete();
        return back();
    }
}
