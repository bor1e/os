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
      $user->first_name = $request['first_name'];
      $user->last_name = $request['last_name'];
      $user->gender = $request['gender'];
      $user->city = $request['city'];
      $user->language = $request['language'];
      $user->facebook =$request['facebook'];
      $user->title =$request['title'];
      if(isset($request['birhtday']))
        $user->birthday =\DateTime::createFromFormat('d.m.Y', $request['birhtday']);
      $user->phone =$request['phone'];
      $user->save();

      return redirect('/courses');
    }
}
