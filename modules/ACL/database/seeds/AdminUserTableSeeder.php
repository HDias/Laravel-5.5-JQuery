<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->where('email', 'admin@admin')->count();

        if ($user < 1) {
            DB::table('users')->insert([
                'name' => 'Horecio',
                'email' => 'admin@admin.com',
                'cpf' => '01428452133',
                'password' => bcrypt('123456')
            ]);

            \Defender::createRole('Admin');
            $suporte = \Defender::createRole(config('defender.restore_role'));

            $suporte->description = 'Perfil para Restaurar Arquivos Deletados';
            $suporte->save();

            $superUserRole = \Defender::createRole(config('defender.superuser_role'));
            foreach (app('acl.model.user')->whereIn('email', [
                'admin@admin.com',
            ])->get() as $user) {
                $user->attachRole($superUserRole);
            }
            echo "Admin user criado!\n";
            echo "email: admin@admin.com\n";
            echo "cpf: 01428452133\n";
            echo "senha:123456\n";
        }
    }
}
