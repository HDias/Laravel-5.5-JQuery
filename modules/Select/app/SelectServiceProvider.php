<?php

namespace Select;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Select\Model\Option;

class SelectServiceProvider extends ServiceProvider
{

    protected $namespace = 'Select\Http\Controllers';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // https://github.com/davejamesmiller/laravel-breadcrumbs/tree/4.2.0#defining-breadcrumbs
        if (class_exists('Breadcrumbs')) {
            require select_path('routes/breadcrumbs.blade.php');
        }

        // registrar View
        \View::addLocation(select_path('resources/views'));
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
            ->group(select_path('routes/select.php'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('select.model.option', Option::class);
    }
}
