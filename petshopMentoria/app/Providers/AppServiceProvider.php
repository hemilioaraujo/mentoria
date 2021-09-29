<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\AnimalRepositoryInterface',
            'App\Repositories\Eloquent\AnimalRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\TutorRepositoryInterface',
            'App\Repositories\Eloquent\TutorRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
