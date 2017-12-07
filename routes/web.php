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

Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
	Route::get('/test',function(){
		return View::make('test');
	});
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

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
