<?php

use Illuminate\Database\Seeder;

class CidadesEstadosSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->command->info('Criando Estados e Cidades...!');

        // https://github.com/chandez/Estados-Cidades-IBGE
        $path = ibge_path('database/seeds/sql/ibge/cidades_estados_brasil.sql');
        DB::unprepared(file_get_contents($path));

        $this->command->info('Estados e Cidades criados!');
    }
}
