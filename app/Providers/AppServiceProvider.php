<?php

namespace App\Providers;

use App\Observers\UserObserver;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);

        // Share the $user variable with all views.
        view()->composer('*', function(View $view){
            $view->with('user', Auth::user());
        });
    }
}
