<?php

namespace App\Providers;

use App\Comment;
use App\File;
use App\Observers\CommentObserver;
use App\Observers\FileObserver;
use App\Observers\PaymentObserver;
use App\Observers\PayoutObserver;
use App\Observers\SubmissionObserver;
use App\Payment;
use App\Payout;
use App\Submission;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Laravel\Telescope\TelescopeServiceProvider;

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
        $this->registerTelescope();
    }

    /**
     * Set all model observers.
     */
    private function setObservers()
    {
        Comment::observe(CommentObserver::class);
        File::observe(FileObserver::class);
        Payment::observe(PaymentObserver::class);
        Payout::observe(PayoutObserver::class);
        Submission::observe(SubmissionObserver::class);
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

    /**
     * Register the Laravel Telescope debugger locally.
     */
    private function registerTelescope()
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}

