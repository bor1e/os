<?php

namespace App\Http\Controllers;

use \App\User;
use App\Events\StatusChange;
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
        $registered = User::whereNotIn('id', \DB::table('role_user')
                  ->pluck('user_id')->all())
                  ->get();

        $email_confirmed = User::withCount('roles')->get()
                    ->where('roles_count',1)
                    ->all();

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

        $users = [
            'email_confirmed' => $email_confirmed,
            'registered' => $registered,
            'members' => $members,
            'pending' => $pending,
            'declined' => $declined,
            'teachers' => $teachers,
        ];
        return view('manage.index', compact('users'));
    }

    public function assignRole($userid, $role)
    {
        if (in_array($role, ['member','teacher','declined','pending','email_confirmed'])) {
          $user = User::findOrFail($userid);

          $user->assignRole($role);
          // TODO:
          // assignedBy should not be a column but a
          // pivot between 'users' and 'role_user'
          // UPDATE: I think it is fine!
          $user->profile->assignedBy = auth()->user()->first_name;
          $user->save();

          if ($role!='email_confirmed') {
            event(new StatusChange($user));
          }
//          if($role=='pending') dd('pending');
          return back();
        }
        else {
          Log::alert('Trying to assign Role \''.$role.'\' to the User with ID: '.$userid);
          abort(451, 'Unathorized action.');
        }
    }
}
