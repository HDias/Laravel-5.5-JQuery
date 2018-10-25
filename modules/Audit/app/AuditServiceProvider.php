<?php

namespace Audit;

use Audity\Model\Audit;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class AuditServiceProvider extends ServiceProvider
{

    protected $namespace = 'Audit\Http\Controllers';

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
            require audit_path('routes/breadcrumbs.blade.php');
        }

        // registrar View
        \View::addLocation(audit_path('resources/views'));

        // Registra pasta de Migrations
        $this->loadMigrationsFrom(audit_path('database/migrations'));
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
            ->group(audit_path('routes/audit.php'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('model.audit', Audit::class);

        $this->app->register(\OwenIt\Auditing\AuditingServiceProvider::class);
    }
}
