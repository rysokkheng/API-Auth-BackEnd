<?php

namespace App\Providers;

use App\Contracts\Repositories\LoginRepositoryInterface;
use App\Contracts\Repositories\PermissionRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\LoginServiceInterface;
use App\Contracts\Services\PermissionServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Repositories\LoginRepositoryEloquent;
use App\Repositories\PermissionRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use App\Services\LoginService;
use App\Services\PermissionService;
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

        $this->app->bind(PermissionServiceInterface::class,PermissionService::class);
        $this->app->bind(PermissionRepositoryInterface::class,PermissionRepositoryEloquent::class);

        $this->app->bind(LoginServiceInterface::class,LoginService::class);
        $this->app->bind(LoginRepositoryInterface::class,LoginRepositoryEloquent::class);
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
