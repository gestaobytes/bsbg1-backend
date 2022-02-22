<?php

use Illuminate\Database\Seeder;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\DB;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (DB::table('users')->get()->count() == 0) {
            DB::table('users')->insert([
                [
                    'id' => 1,
                    'registration' => 'Sim',
                    'name' => 'GestaoBytes',
                    'genre' => 'M',
                    // 'birthday' => '2000-01-01',
                    'cpf' => '170.911.201-09',
                    'rg' => '170.911-00',
                    'image' => '',
                    'status' => 'ON',
                    'phone' => '(62)3314-3335',
                    'cellphone' => '(62)99448-7733',
                    'cellphone2' => '(62)99448-7733',
                    'email' => 'super-admin@gestaobytes.com',
                    'password' =>  (new BcryptHasher)->make("vagrant"),
                    'type' => 'Servidor',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 2,
                    'registration' => 'Sim',
                    'name' => 'GestaoBytes',
                    'genre' => 'M',
                    // 'birthday' => '2000-01-01',
                    'cpf' => '170.911.201-09',
                    'rg' => '170.911-00',
                    'image' => '',
                    'status' => 'ON',
                    'phone' => '(62)3314-3335',
                    'cellphone' => '(62)99448-7733',
                    'cellphone2' => '(62)99448-7733',
                    'email' => 'admin@gestaobytes.com',
                    'password' =>  (new BcryptHasher)->make("vagrant"),
                    'type' => 'Servidor',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 3,
                    'registration' => 'Sim',
                    'name' => 'DARLEY LIMA',
                    'genre' => 'M',
                    // 'birthday' => '2000-01-01',
                    'cpf' => '170.911.201-09',
                    'rg' => '170.911-00',
                    'image' => '',
                    'status' => 'ON',
                    'phone' => '(62)3314-3335',
                    'cellphone' => '(62)99448-7733',
                    'cellphone2' => '(62)99448-7733',
                    'email' => 'user@gestaobytes.com',
                    'password' =>  (new BcryptHasher)->make("vagrant"),
                    'type' => 'Servidor',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 4,
                    'registration' => 'Sim',
                    'name' => 'CLEBERSON NASCIMENTO',
                    'genre' => 'M',
                    // 'birthday' => '2000-01-01',
                    'cpf' => '170.911.201-09',
                    'rg' => '170.911-00',
                    'image' => '',
                    'status' => 'ON',
                    'phone' => '(62)3314-3335',
                    'cellphone' => '(62)99448-7733',
                    'cellphone2' => '(62)99448-7733',
                    'email' => 'usuario@segov.com',
                    'password' =>  (new BcryptHasher)->make("vagrant"),
                    'type' => 'Servidor',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 5,
                    'registration' => 'Sim',
                    'name' => 'GRAÇA ARANHA',
                    'genre' => 'M',
                    // 'birthday' => '2000-01-01',
                    'cpf' => '170.911.201-09',
                    'rg' => '170.911-00',
                    'image' => '',
                    'status' => 'ON',
                    'phone' => '(62)3314-3335',
                    'cellphone' => '(62)99448-7733',
                    'cellphone2' => '(62)99448-7733',
                    'email' => 'secretario@segov.com',
                    'password' =>  (new BcryptHasher)->make("vagrant"),
                    'type' => 'Servidor',
                    'created_at' => date('Y-m-d H:i:s'),
                ],

            ]);
        } else {
            echo "\e[31m Users não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }
}
