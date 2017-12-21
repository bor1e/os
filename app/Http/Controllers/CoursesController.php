<?php

namespace App\Http\Controllers;

use App\Course;
use App\Teacher;
use Illuminate\Http\Request;

class CoursesController extends Controller
{

  public function __construct()
  {
      $this->middleware(['auth','can:create,App\Course'])->only('store');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$courses = Course::orderBy('datetimetz', 'desc')->get();
        //$courses = Course::where('datetimetz','<',date('m.d.Y H:i'))->orderBy('datetimetz', 'desc')->get();
        $courses = Course::where('datetimetz','>=',now())->orderBy('datetimetz')->get();
        /*$courses = Course::sortBy(function($course, $key){
          return abs(strtotime(date('d.m.Y H:i')) - strtotime($course));
        })->get();*/
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
    public function store(Request $request)
    {
      $format = 'd.m.Y H:i';
      $datetimetz = \DateTime::createFromFormat($format, $request['datetimetz'] , new \DateTimeZone('Europe/Berlin'));

        $course = Course::create([
          'title' => $request['title'],
          'datetimetz' => $datetimetz,
          'description' => $request['description'],
          'body' => $request['body'],
          'language' => $request['language'],
          'slug' => $request['slug'],
          'g2m_id' => $request['g2m_id'],
          'cycle' => $request['cycle'],
        ]);

        if (auth()->user()->hasRole('teacher')) {
          Teacher::create([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
          ]);
        }

        return redirect($course->path());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
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
}
