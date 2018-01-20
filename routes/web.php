<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#Route::get('/mailable', function () {
#    $user = App\User::find(1);
#
#    return new App\Mail\UserHasRegisteredMail($user);
#});

Route::get('/', function () {
    return view('alt');
})->name('home');

Route::get('/alt', function () {
    return view('welcome');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/about-us', function () {
    return view('about-us');
});

Route::get('/imprint', function () {
    return view('imprint');
});

Route::post('contact', 'ContactForm@send')->name('contact');

Route::get('/courses', 'CoursesController@index');
Route::get('/courses/create', 'CoursesController@create')->middleware('can:create,App\Course');
//Route::post('/courses/{course}/update', 'CoursesController@edit');
Route::get('/courses/{channel}', 'CoursesController@index');
Route::get('/courses/{channel}/{course}', 'CoursesController@show');
Route::get('/courses/{channel}/{course}/edit', 'CoursesController@edit');
Route::post('/courses/{channel}/{course}/edit', 'CoursesController@update');
Route::post('/courses/{channel}/{course}/enroll', 'ParticipantsController@store')->middleware('can:participateInCourse');
Route::post('/courses/{channel}/{course}/revokeEnrollment', 'ParticipantsController@destroy')->middleware('can:participateInCourse');
Route::post('/courses/{channel}/{course}/feedback', 'CourseFeedbacksController@store');
Route::post('/courses', 'CoursesController@store')->middleware('can:create,App\Course');

Auth::routes();

Route::get('/teacher/{teacher}', 'TeachersController@show')->name('teacher.show');

Route::prefix('shomer')->group(function () {
  #Route::middleware(['middleware' => 'auth'])->group(function() {
  Route::middleware(['middleware' => 'can:manageUsers'])->group(function() {
    Route::get('users', 'ManageUsersController@index')->name('manageUsers');
    Route::get('teacher', 'TeachersController@index');
    Route::post('teacher', 'TeachersController@store');
    Route::get('teacher/create', 'TeachersController@create');
    Route::get('teacher/{teacher}', 'TeachersController@show');
    Route::post('teacher/{teacher}', 'TeachersController@update');
    Route::get('{userid}/{role}', 'ManageUsersController@assignRole');
  });
});
Route::get('/profile', 'UsersController@index')->middleware('auth');
Route::put('/profile', 'UsersController@update')->middleware('auth');
Route::get('verify_email/{token}', 'EmailController@verify')->name('verify_email');
