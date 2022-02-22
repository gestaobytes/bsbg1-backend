<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (DB::table('role_user')->get()->count() == 0) {
            DB::table('role_user')->insert([
                    ['user_id' => 1, 'role_id' => 1, 'created_at' => date('Y-m-d H:i:s'),],
                    ['user_id' => 2, 'role_id' => 2, 'created_at' => date('Y-m-d H:i:s'),],
            ]);
        } else {
            echo "\e[31m Role_User não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }
}
