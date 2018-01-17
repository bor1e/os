<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        return view('auth.edit',compact('user'));
    }

    public function update(Request $request)
    {
      $user = auth()->user();

      $user->profile->title =$request['title'];
      $user->profile->phone =$request['phone'];
      $user->profile->city = $request['city'];
      $user->profile->country = $request['country'];
      $user->profile->timezone = $request['timezone'];
      $user->profile->language = $request['language'];
      $user->profile->social_profile = $request['social_profile'];
      $user->profile->quotes = $request['quotes'];
      if(isset($request['birhtday']))
        $user->profile->birthday =\DateTime::createFromFormat('d.m.Y', $request['birhtday']);

      $user->profile->save();

      $user->first_name = $request['first_name'];
      $user->last_name = $request['last_name'];
      $user->gender = $request['gender'];
      $user->save();

      return redirect('/courses');
    }
}
