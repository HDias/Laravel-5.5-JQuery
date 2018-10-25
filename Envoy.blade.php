@servers(['web' => 'deployer@IP_ADDRESS'])

@setup
    $releases_dir = '/var/www/FOLDER_PROJECT';
    $beginTime = date('d/m/Y H:i:s');
@endsetup

@task('env')
    echo "Iniciando copia de files({{ $beginTime }})"
    cd {{ $releases_dir .'/'. $env }}
    cp .env.example .env
    ls -la
@endtask

@task('seed_admin')
    cd {{ $releases_dir .'/'. $env }}
    php artisan db:seed --class=AdminUserTableSeeder --force
@endtask

@task('deploy')
    {{-- Updade Git--}}

    echo "******** INICIANDO DEPLOYMENT ({{ $beginTime }}) **************"
    cd {{ $releases_dir .'/'. $env }}
    git pull origin {{ $branch }}

    {{-- Fim Updade Git--}}

    {{-- Run Composer --}}
    echo "[START composer update ({{ $beginTime }})]"
    composer update --no-dev -q
    {{-- Fim Composer --}}

    echo "[START ARTISAN ({{ $beginTime }})]"
    php artisan key:generate
    php artisan cache:forget lang.js
    php artisan config:cache

    {{-- MIGRATE --}}

    php artisan migrate --seed --force

    echo "********* DEPLOY FINALIZADO ************"
@endtask

{{-- WARNING --}}
@task('deployRefresh')
    echo "******** Iniciado DEPLOYMENT REFRESH ({{ $beginTime }}) **************"

    {{-- GIT UPDATE --}}
    cd {{ $releases_dir .'/'. $env }}
    git pull origin {{ $branch }}
    {{-- Fim Updade Git--}}

    {{-- Run Composer --}}
    echo "[START composer update ({{ $beginTime }})]"
    composer update --no-dev -q
    {{-- Fim Composer --}}

    echo "[START ARTISAN]"
    php artisan key:generate --force
    php artisan cache:forget lang.js
    php artisan config:cache

    {{-- MIGRATE --}}
    php artisan migrate:reset --force
    php artisan migrate --seed --force
    php artisan louzada:create:permission --force

    echo "********* DEPLOY FINALIZADO ************"
@endtask

@task('migrate')
    echo "[Ciação de Tabelas INICIADA]"
    cd {{ $releases_dir .'/'. $env }}
    php artisan migrate --force
    echo "[FINALIZADO]"
@endtask

@task('migrateRefresh')
    echo "[Ciação de Tabelas INICIADA]"
    cd {{ $releases_dir .'/'. $env }}
    php artisan migrate:reset --force
    php artisan migrate --seed --force
    php artisan louzada:create:permission --force
    echo "[FINALIZADO]"
@endtask

@task('permissions')
    echo "[Ciação de Permissions INICIADA]"
    {{-- Create Permissions from routes --}}
    cd {{ $releases_dir .'/'. $env }}
    php artisan louzada:create:permission --force
    {{-- Fim ARTISAN --}}
    echo "[FINALIZADO]"
@endtask