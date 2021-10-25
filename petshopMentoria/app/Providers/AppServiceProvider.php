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

        $this->app->bind(
            'App\Repositories\Contracts\ServicoRepositoryInterface',
            'App\Repositories\Eloquent\ServicoRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\FuncionarioRepositoryInterface',
            'App\Repositories\Eloquent\FuncionarioRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\FuncionarioServicoRepositoryInterface',
            'App\Repositories\Eloquent\FuncionarioServicoRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\AgendamentoRepositoryInterface',
            'App\Repositories\Eloquent\AgendamentoRepository'
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
