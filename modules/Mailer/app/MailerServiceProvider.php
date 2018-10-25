<?php

namespace Mailer;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Mailer\Model\MailActivation;

class MailerServiceProvider extends ServiceProvider
{

    protected $namespace = 'Mailer\Http\Controllers';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // registrar View
        \View::addLocation(mailer_path('resources/views'));

        // Registra pasta de Migrations
        $this->loadMigrationsFrom(mailer_path('database/migrations'));
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
            ->group(mailer_path('routes/mailer.php'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('mailer.login_activation', LoginActivation::class);
        $this->app->bind('mailer.model.mail_activation', MailActivation::class);
    }
}
