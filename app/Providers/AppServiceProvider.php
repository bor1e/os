<?php

namespace App\Providers;

use App\Channel;
use App\Teacher;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Cashier::useCurrency('eur', '€');
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
