<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\Profile;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:manageUsers')->only(['create','store','edit','update']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teacher.index')->with('teachers',Teacher::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'gender' => 'required|in:male,female',
            'salary' => 'digits_between:0,3',
            'email' => 'email|required|unique:teachers,email',
            'birthday' => 'nullable|date_format:d.m.Y',
        ]);
        $profile = [
            'type' => 'teacher',
            'title' => $request->title,
            'phone' => $request->phone,
            'city' => $request->city,
            'country' => $request->country,
            'timezone' => $request->timezone,
            'language' => $request->language,
            'social_profile' => $request->social_profile,
            'birthday' => $this->convertDate($request->birthday),
            'quotes' => $request->quotes,
            'hobbies' => $request->hobbies,
            'message' => $request->message,
            'notes' => $request->notes,
            'assignedBy' => auth()->user()->first_name,
        ];

        $teacher = Teacher::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'salary' => $request->salary,
            // TODO: russian slug:
            #https://stackoverflow.com/questions/7461406/cyrillic-transliteration-in-php
            'slug' => strtolower(now()->format('oz') .'-'. $request->first_name .'-'.  $request->last_name),
            'profile_id' => Profile::create($profile)->id,
        ]);

        return redirect()->route('teacher.show', $teacher);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return view('teacher.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        return view('teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        #dd($request->toArray());
        $request->validate([
            'title' => 'nullable|string',
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'gender' => 'required|in:male,female',
            'salary' => 'between:0,150',
            'email' => 'exists:teachers,email',
            'phone' => 'nullable|regex:/^[+]?[0-9]+$/',
            'city' => 'string|nullable',
            'country' => 'string|nullable',
            'birthday' => 'nullable|date_format:d.m.Y',
        ]);
        $teacher->profile->title = $request->title;
        $teacher->profile->phone = $request->phone;
        $teacher->profile->city = $request->city;
        $teacher->profile->country = $request->country;
        $teacher->profile->timezone = $request->timezone;
        $teacher->profile->language = $request->language;
        $teacher->profile->social_profile = $request->social_profile;
        $teacher->profile->birthday = $this->convertDate($request->birthday);
        $teacher->profile->quotes = $request->quotes;
        $teacher->profile->hobbies = $request->hobbies;
        $teacher->profile->message = $request->message;
        $teacher->profile->notes = $request->notes;
        #dd($request->toArray());
        $teacher->profile->save();
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->gender = $request->gender;
        $teacher->salary = $request->salary;
        $teacher->email = $request->email;
        $teacher->save();

        return view('teacher.show', compact('teacher'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }

    public function convertDate($date, $timezone=null)
    {
      if(!$date) return null;
      if(!$timezone) $timezone='Europe/Berlin';

      $format = 'd.m.Y';
      $date = \DateTime::createFromFormat($format, $date , new \DateTimeZone($timezone));
      return $date;
    }
}
