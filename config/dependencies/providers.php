<?php

$production = [
    /*
     * Laravel Framework Service Providers...
     */
    Illuminate\Auth\AuthServiceProvider::class,
    Illuminate\Broadcasting\BroadcastServiceProvider::class,
    Illuminate\Bus\BusServiceProvider::class,
    Illuminate\Cache\CacheServiceProvider::class,
    Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
    Illuminate\Cookie\CookieServiceProvider::class,
    Illuminate\Database\DatabaseServiceProvider::class,
    Illuminate\Encryption\EncryptionServiceProvider::class,
    Illuminate\Filesystem\FilesystemServiceProvider::class,
    Illuminate\Foundation\Providers\FoundationServiceProvider::class,
    Illuminate\Hashing\HashServiceProvider::class,
    Illuminate\Mail\MailServiceProvider::class,
    Illuminate\Notifications\NotificationServiceProvider::class,
    Illuminate\Pagination\PaginationServiceProvider::class,
    Illuminate\Pipeline\PipelineServiceProvider::class,
    Illuminate\Queue\QueueServiceProvider::class,
    Illuminate\Redis\RedisServiceProvider::class,
    Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
    Illuminate\Session\SessionServiceProvider::class,
    Illuminate\Translation\TranslationServiceProvider::class,
    Illuminate\Validation\ValidationServiceProvider::class,
    Illuminate\View\ViewServiceProvider::class,

    /*
     * Application Service Providers...
     */
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    // App\Providers\BroadcastServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\RouteServiceProvider::class,

    /**
     *  External
     */
    // http://image.intervention.io/
    Intervention\Image\ImageServiceProvider::class,
    // https://github.com/Askedio/laravel-soft-cascade/tree/5.5.14
    Askedio\SoftCascade\Providers\GenericServiceProvider::class,
    // https://github.com/unicodeveloper/laravel-password
    Unicodeveloper\DumbPassword\DumbPasswordServiceProvider::class,
    // https://github.com/shvetsgroup/laravel-email-database-log
    ShvetsGroup\LaravelEmailDatabaseLog\LaravelEmailDatabaseLogServiceProvider::class,
    // https://github.com/aginev/login-activity
    Aginev\LoginActivity\LoginActivityServiceProvider::class,

    /**
     * Modules
     */
    \ACL\ACLServiceProvider::class,
    \Audit\AuditServiceProvider::class,
    \Mailer\MailerServiceProvider::class,
    \Select\SelectServiceProvider::class,
    \IBGE\IBGEServiceProvider::class
];

$local = [
    /**
     * https://github.com/barryvdh/laravel-debugbar
     */
    Barryvdh\Debugbar\ServiceProvider::class,
    Krlove\EloquentModelGenerator\Provider\GeneratorServiceProvider::class,
];

$packages = $production;

if (env('APP_ENV') == 'local') {
    $packages = array_merge($production, $local);
}

return $packages;
