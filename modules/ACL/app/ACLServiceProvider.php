<?php

namespace ACL;

use ACL\Model\Permission;
use ACL\Model\Role;
use ACL\Model\User;
use ACL\Service\UserService;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class ACLServiceProvider extends ServiceProvider
{

    protected $namespace = 'ACL\Http\Controllers';

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
            require acl_path('routes/breadcrumbs.blade.php');
        }

        // registrar View
        \View::addLocation(acl_path('resources/views'));

        // Registra pasta de Migrations
        $this->loadMigrationsFrom(acl_path('database/migrations'));
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
        \Route::middleware('web')
            ->namespace($this->namespace)
            ->group(acl_path('routes/acl.php'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Models
        $this->app->bind('acl.model.permission', Permission::class);
        $this->app->bind('acl.model.role', Role::class);
        $this->app->bind('acl.model.user', User::class);

        // Service        
        $this->app->bind('acl.service.user', UserService::class);

        $this->app->register(\Artesaos\Defender\Providers\DefenderServiceProvider::class);
        $this->app->alias('Defender', \Artesaos\Defender\Facades\Defender::class);

    }
}
