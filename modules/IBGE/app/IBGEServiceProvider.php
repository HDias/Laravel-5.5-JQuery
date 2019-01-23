<?php

namespace IBGE;

use IBGE\Model\Cidade;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class IBGEServiceProvider extends ServiceProvider
{

    protected $namespace = 'IBGE\Http\Controllers';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Registra pasta de Migrations
//        $this->loadMigrationsFrom(ibge_path('database/migrations'));
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(ibge_path('routes/ibge.php'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ibge.model.cidade', Cidade::class);
    }
}
