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
Route::get('/courses/{course}', 'CoursesController@show');
Route::post('/courses/{course}/enroll', 'ParticipantsController@store');
Route::post('/courses/{course}/feedback', 'CourseFeedbacksController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('shomer')->group(function () {
  Route::middleware(['middleware' => 'can:manageUsers'])->group(function() {
    Route::get('users', 'ManageUsersController@index')->name('manageUsers');
    Route::get('/{userid}/{role}', 'ManageUsersController@assignRole');
  });
});
