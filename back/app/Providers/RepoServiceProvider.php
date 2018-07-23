<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\Repository\ResourcesEloquent;
use App\Http\Repository\ResourcesInterface;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ResourcesEloquent::class,ResourcesInterface::class);
    }
}
