<?php

namespace App\Http\Controllers;

use App\Course;
use App\Teacher;
use App\Channel;
use App\Filters\CourseFilters;
use App\Http\Requests\CourseFormRequest;
use App\Events\CourseMessage;
use Illuminate\Http\Request;

class CoursesController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth')->except(['index','show','home', 'archives']);
    $this->middleware('can:create,App\Course')->only(['contact','create','store']);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, CourseFilters $filters)
    {
      if($channel->exists) {
        $courses = $channel->courses()->latest()->get();
      }
      else {
        #FIXME check if course already finished
        $courses = Course::where('date','>=',today())
                    #->where('time', '>=', now())
                    ->orderBy('date')
                    ->orderBy('time')
                    ->get();
      }
      if($teacher_last_name=request('by')) {
        #dd(request());

        $teacher = Teacher::where('last_name', $teacher_last_name)->firstOrFail();
        #$courses = $teacher->courses()->get();
        $courses = $this->getCourses($channel, $filters);
      }

      return view('courses.index', compact('courses'));
    }

    public function home()
    {
        #FIXME check if course already finished
        $courses = Course::where('date','>=',today())
                    #->where('time', '>=', now())
                    ->orderBy('date')
                    ->orderBy('time')
                    ->get();

        $archives = Course::inRandomOrder()->where('date','<',today())->get();

        return view('home.index', compact('courses', 'archives'));
    }

    public function archives()
    {
        //TODO order the archives
        $archives = Course::inRandomOrder()->where('date','<',today())->get();
        return view('home.archives', compact('archives'));
    }

    public function contact($channel, Course $course, Request $request)
    {
        event(new CourseMessage($course, $request['message-text']));
        return redirect($course->path());

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

    /**
     * Fetch all relevant threads.
     *
     * @param Channel       $channel
     * @param CourseFilters $filters
     * @return mixed
     */
    protected function getCourses(Channel $channel, CourseFilters $filters)
    {
        $courses = Course::latest()->filter($filters);
        if ($channel->exists) {
            $courses->where('channel_id', $channel->id);
        }
        return $courses->get();
    }

    public function convertDate($date)
    {
      if(!$date) return null;
      $format = 'd.m.Y';
      $date = \DateTime::createFromFormat($format, $date , new \DateTimeZone('Europe/Berlin'));
      return $date;
    }
}
