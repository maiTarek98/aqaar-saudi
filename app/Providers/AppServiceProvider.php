<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        // $this->app->bind('path.public', function() {
        //     return base_path('public_html');
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        \Carbon\Carbon::setWeekStartsAt(\Carbon\Carbon::SATURDAY);

        view()->composer('*', function ($view) 
        {
            if(auth('web')->check()){
                $unreadCount = auth('web')->user()->unreadNotifications()->count();
            }else{
                $unreadCount = null;
            }
            $view->with(compact('unreadCount'));

        });   

        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}
