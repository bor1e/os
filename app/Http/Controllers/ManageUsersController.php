<?php

namespace App\Http\Controllers;

use \App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ManageUsersController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','can:manageUsers']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newUsers = User::whereNotIn('id', \DB::table('role_user')
                  ->pluck('user_id')->all())
                  ->get();

        $teachers = User::join('role_user','users.id','role_user.user_id')
                  ->join('roles','role_user.role_id','roles.id')
                  ->where('roles.name','like','teacher')
                  ->get();

        $members = User::join('role_user','users.id','role_user.user_id')
                  ->join('roles','role_user.role_id','roles.id')
                  ->where('roles.name','like','member')
                  ->get();

        $pending = User::join('role_user','users.id','role_user.user_id')
                  ->join('roles','role_user.role_id','roles.id')
                  ->where('roles.name','like','pending')
                  ->get();

        $declined = User::join('role_user','users.id','role_user.user_id')
                  ->join('roles','role_user.role_id','roles.id')
                  ->where('roles.name','like','declined')
                  ->get();

        return view('manage.index', compact('newUsers','members','teachers','declined','pending'));
    }

    public function assignRole($userid, $role)
    {
        if (in_array($role, ['member','teacher','declined','pending'])) {
          $user = User::findOrFail($userid);

          $user->assignRole($role);

          // TODO:
          // assignedBy should not be a column but a
          // pivot between 'users' and 'role_user'
          $user->assignedBy = auth()->user()->first_name;
          $user->save();
//          if($role=='pending') dd('pending');
          return back();
        }
        else {
          Log::alert('Trying to assign Role \''.$role.'\' to the User with ID: '.$userid);
          abort(451, 'Unathorized action.');
        }
    }
}
