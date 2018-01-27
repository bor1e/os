<?php

namespace App\Http\Controllers;

use App\Course;
use App\Participant;
use App\Jobs\EnrollmentJob;
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
        // TODO: do I need to pass course_id????
        $course->addParticipant([
        #    'course_id' => $course->id,
            'user_id' => auth()->id(),
        ]);
        $us = '';
        if (!($us = Participant::where('user_id',auth()->id()))->count()){
            EnrollmentJob::dispatch(auth()->user())
                ->delay(now()->addMinutes(15))
                ->onQueue('emails');
                return back();
        }

        if ($us->where('created_at','<',\Carbon\Carbon::now()->subMinutes(15)->toDateTimeString())->count()) {
            EnrollmentJob::dispatch(auth()->user())
            ->delay(now()->addMinutes(15))
            ->onQueue('emails');
        }

        return back();


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
