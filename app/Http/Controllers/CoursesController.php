<?php

namespace App\Http\Controllers;

use App\Course;
use App\Teacher;
use App\Channel;
use App\Http\Requests\CourseFormRequest;


class CoursesController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth')->except(['index','show']);
    $this->middleware('can:create,App\Course')->only(['create','store']);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel)
    {
      if($channel->exists) {
        $courses = $channel->courses()->latest()->get();
      }
      else {
        $courses = Course::where('date','>=',now())->orderBy('date')->orderBy('time')->get();
      }
      if($teacher_last_name=request('by')) {
        #dd(request());
        $teacher = Teacher::where('last_name', $teacher_last_name)->firstOrFail();
        $courses = $teacher->courses()->get();
      }

      return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseFormRequest $request)
    {
    
        $course = Course::create([
          'title' => $request->title,
          'date' => $this->convertDate($request->date),
          'time' => date('H:i',strtotime($request->time)),
          'description' => $request->description,
          'body' => $request->body,
          'language' => $request->language,
          'slug' => $request->slug,
          'g2m_id' => $request->g2m_id,
          'dedication' => $request->dedication,
          'intervall' => $request->intervall,
          'meetings' => $request->meetings,
          'cost' => $request->cost,
          'channel_id' => $request->channel_id,
          'teacher_id' => $request->teacher_id,// TODO: if user has role teacher
          'status' => $request->status,
          'notes' => $request->notes,
        ]);
        #if (auth()->user()->hasRole('teacher')) {
        #  Teacher::create([
    #        'user_id' => auth()->id(),
    #        'course_id' => $course->id,
    #      ]);
    #    }


        return redirect($course->path());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($channel, Course $course)
    {
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($channel, Course $course)
    {
      $this->authorize('update',$course);
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseFormRequest $request, $channel, Course $course)
    {

      $this->authorize('update',$course);
      $new_course = Course::findOrFail($course)->first();
      $new_course->title = $request->title;
      $new_course->date = $this->convertDate($request->date);
      $new_course->time = date('H:i',strtotime($request->time));
      $new_course->description = $request->description;
      $new_course->body = $request->body;
      $new_course->language = $request->language;
      $new_course->slug = $request->slug;
      $new_course->g2m_id = $request->g2m_id;
      $new_course->dedication = $request->dedication;
      $new_course->intervall = $request->intervall;
      $new_course->meetings = $request->meetings;
      $new_course->cost = $request->cost;
      $new_course->channel_id = $request->channel_id;
      $new_course->teacher_id = $request->teacher_id;
      $new_course->status = $request->status;
      $new_course->notes = $request->notes;
      $new_course->save();

      return redirect($course->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }

    public function convertDate($date)
    {
      if(!$date) return null;
      $format = 'd.m.Y';
      $date = \DateTime::createFromFormat($format, $date , new \DateTimeZone('Europe/Berlin'));
      return $date;
    }
}
