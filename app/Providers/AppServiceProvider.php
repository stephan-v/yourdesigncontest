<?php

namespace App\Providers;

use App\Comment;
use App\Observers\CommentObserver;
use App\Observers\WinnerObserver;
use App\Winner;
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
        $this->setObservers();
        $this->setViewComposer();
    }

    /**
     * Set all model observers.
     */
    private function setObservers()
    {
        Winner::observe(WinnerObserver::class);
        Comment::observe(CommentObserver::class);;
    }

    /**
     * Set the shared data for all views.
     */
    private function setViewComposer()
    {
        view()->composer('*', function (View $view) {
            $view->with('user', Auth::user());
        });
    }
}
