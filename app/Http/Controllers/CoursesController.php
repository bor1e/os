<?php

namespace App\Http\Controllers;

use App\Course;
use App\Teacher;
use App\Channel;
use Illuminate\Http\Request;

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
        $courses = Course::where('datetimetz','>=',now())->orderBy('datetimetz')->get();
      }
      if($teacher_last_name=request('by')) {
        //by Zboncak
        $user = \App\User::where('last_name',$teacher_last_name)->firstOrFail();
        // user id 12
        #$teacher  = \App\Teacher::where('user_id',$user->id)->firstOrFail();
        #$courses = $teacher->courses()->get();

        #$teacher  = \App\Teacher::where('user_id',$user->id)->get()->pluck('course_id')->all();
        #$courses = Course::find($teacher);
        $courses = \App\Teacher::where('user_id',$user->id)->first()->courses($user->id);

        //dd($courses);
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
    public function store(Request $request)
    {
        $this->validate($request, [
              'title' => 'required|min:6|max:60',
              'body'  => 'required|min:100',
              'description' => 'required|min:50|max:160',
              'language' => 'required',
              'cycle' => 'required',
              'slug' => 'required',
              'g2m_id' => 'required|min:9',
              'datetimetz' => 'required|date_format:d.m.Y H:i',
              'channel_id' => 'required|exists:channels,id',
          ]);


        $course = Course::create([
          'title' => $request['title'],
          'datetimetz' => $this->convertDate($request['datetimetz']),
          'description' => $request['description'],
          'body' => $request['body'],
          'language' => $request['language'],
          'slug' => $request['slug'],
          'dedication' => $request['dedication'],
          'g2m_id' => $request['g2m_id'],
          'cycle' => $request['cycle'],
          'channel_id' => $request['channel_id'],
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
    public function update(Request $request, $channel, Course $course)
    {
      $this->validate($request, [
        'title' => 'required|min:6|max:60',
        'body'  => 'required|min:100',
        'description' => 'required|min:50|max:160',
        'language' => 'required',
        'cycle' => 'required',
        'slug' => 'required',
        'g2m_id' => 'required|min:9',
        'datetimetz' => 'required|date_format:"d.m.Y H:i"|after:now',
        'channel_id' => 'required|exists:channels,id',
        ]);

      $this->authorize('update',$course);
      $new_course = Course::findOrFail($course)->first();
      $new_course->title = $request->title;
      $new_course->datetimetz = $this->convertDate($request->datetimetz);
      $new_course->description = $request->description;
      $new_course->body = $request->body;
      $new_course->language = $request->language;
      $new_course->dedication = $request->dedication;
      $new_course->slug = $request->slug;
      $new_course->g2m_id = $request->g2m_id;
      $new_course->channel_id = $request->channel_id;
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
      $format = 'd.m.Y H:i';
      $datetimetz = \DateTime::createFromFormat($format, $date , new \DateTimeZone('Europe/Berlin'));
      return   $datetimetz;
    }
}
