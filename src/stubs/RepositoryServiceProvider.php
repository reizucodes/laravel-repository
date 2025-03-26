<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\BlaiseBueno\LaravelRepository\Repositories\Interfaces\EloquentInterface::class, \BlaiseBueno\LaravelRepository\Repositories\BaseRepository::class);
    }

}
