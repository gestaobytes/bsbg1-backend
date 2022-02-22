<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (DB::table('roles')->get()->count() == 0) {
            DB::table('roles')->insert([
                [
                    'id' => 1,
                    'name' => 'SuperAdmin',
                    'label' => 'Perfil com acesso a todos os controles do sistema.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 2,
                    'name' => 'Administrador',
                    'label' => 'Perfil com acesso a todos os controles do sistema, exceto a criação de um novo usuário Admin',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 3,
                    'name' => 'Editor',
                    'label' => 'Perfil com acesso para a liberação das matérias ou colunas, além da edição.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 4,
                    'name' => 'Reporter/Colunista',
                    'label' => 'Perfil com acesso somente para as matérias que escreveu',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 5,
                    'name' => 'Leitor',
                    'label' => 'Perfil com acesso somente para as matérias que escreveu',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 6,
                    'name' => 'Anunciante',
                    'label' => 'Perfil com acesso somente para as matérias que escreveu',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
            ]);
        } else {
            echo "\e[31mRoles não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }
}
