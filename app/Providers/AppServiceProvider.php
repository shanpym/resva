<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         //
        //check that app is local
        // if ($this->app->isLocal()) {
        // //if local register your services you require for development
        //     // $this->app->register('Barryvdh\Debugbar\ServiceProvider');
        // } else {
        // //else register your services you require for production
        //     $this->app['request']->server->set('HTTPS', true);
        // }
        // URL::forceScheme('https');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        View::composer('admin.include.sidebar', function ($view) {
            $notifications = DB::table('booking')->where('status', '1')->get();
            $dateToday = date('Y-m-d'); 
            $toarrive = DB::table('booking')
            ->where('start_date', $dateToday)
            ->where('status', '2')
            ->get();
            $todepart = DB::table('booking')
            ->where('end_date', $dateToday)
            ->where('status', '5')
            ->get();
            $view->with([
                'notifications' => $notifications,
                'toarrive' => $toarrive,
                'todepart' => $todepart
            ]);
        });

        View::composer('user.include.sidebar', function ($view) {
            $user = Auth::user();
            $view->with([
                'user' => $user,
            ]);
        });
    }
}
