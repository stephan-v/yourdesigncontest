<?php

namespace App\Providers;

use App\Comment;
use App\Observers\CommentObserver;
use App\Observers\SubmissionObserver;
use App\Observers\WinnerObserver;
use App\Submission;
use App\Winner;
use Illuminate\Support\Facades\App;
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
        Comment::observe(CommentObserver::class);
        Submission::observe(SubmissionObserver::class);
        Winner::observe(WinnerObserver::class);
    }

    /**
     * Set the shared data for all views.
     */
    private function setViewComposer()
    {
        view()->composer('*', function (View $view) {
            $view->with('user', Auth::user());
            $view->with('production', App::environment('production'));
        });
    }
}
