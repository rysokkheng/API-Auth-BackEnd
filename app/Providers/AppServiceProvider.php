<?php

namespace App\Providers;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Repositories\UserRepositoryEloquent;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;
use  Illuminate\Support\Facades\Schema;
use Prettus\Repository\Providers\RepositoryServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserServiceInterface::class,UserService::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepositoryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->register(RepositoryServiceProvider::class);
         Schema::defaultStringLength(191);
    }
}
