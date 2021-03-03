<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\File;
use App\Observers\CommentObserver;
use App\Observers\FileObserver;
use App\Observers\PaymentObserver;
use App\Observers\PayoutObserver;
use App\Observers\SubmissionObserver;
use App\Models\Payment;
use App\Models\Payout;
use App\Models\Submission;
use Illuminate\Pagination\Paginator;
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
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setObservers();
        $this->setPaginator();
        $this->setViewComposer();
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
     * Set the paginator options.
     */
    private function setPaginator()
    {
        Paginator::useBootstrap();
    }
}

