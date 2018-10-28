<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        if (isEnv('local')) {
            $this->call([
                AdminUserTableSeeder::class,
            ]);
        }

        if (isEnv('production')) {
            $this->call([
                AdminUserTableSeeder::class,
            ]);
        }
    }
}
