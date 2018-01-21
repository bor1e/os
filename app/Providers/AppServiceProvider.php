<?php

namespace App\Providers;

use App\Channel;
use App\Teacher;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      #\View::share('channels',Channel::all());
      \View::composer('*', function ($view)
      {
        $view->with('channels', Channel::all());
        $view->with('teachers', Teacher::all());

      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
