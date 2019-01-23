<?php

namespace ACL\Console\Commands;

use Illuminate\Console\Command;

class DatabaseCreate extends Command
{

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Only Postgre databases';

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'hdias:db:pg {--create : To Create} {--drop : To Drop}';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        \Artisan::call('config:clear');

        $database = env('DB_DATABASE', false);

        if (!$database) {
            $this->info('Skipping creation of database as env(DB_DATABASE) is empty');

            return false;
        }

        if (!$this->option('create') && !$this->option('drop')) {
            $this->info('Skipping choose DROP or CREATE');

            return false;
        }

        try {
            $pdo = $this->getPDOConnection(env('DB_HOST'), env('DB_PORT'), $database, env('DB_USERNAME'), env('DB_PASSWORD'));


            if ($this->option('create')) {
                $command = "CREATE DATABASE {$database};";

                $message = 'CREATED ';
            }

            if ($this->option('drop')) {
                $command = "DROP DATABASE {$database};";

                $message = 'DROPPED ';
            }

            $pdo->exec($command);

            $this->info($message . $database . ' Success!');

        } catch (\PDOException $exception) {
            $this->error(sprintf('Failed to create %s database, %s', $database, $exception->getMessage()));
        }
//        \Artisan::call('config:cache');
    }

    /**
     * @param  string $host
     * @param  integer $port
     * @param  string $username
     * @param  string $password
     * @return \PDO
     */
    private function getPDOConnection($host, $port, $dbName, $username, $password)
    {
        $command = "pgsql:host={$host};port={$port};dbname={$dbName};user={$username};password={$password}";
        return new \PDO($command);
    }
}