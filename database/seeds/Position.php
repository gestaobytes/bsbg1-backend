<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Position extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (DB::table('positions')->get()->count() == 0) {
            DB::table('positions')->insert([
                [
                    'title' => 'Destaque',
                    'image' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
            ]);
        } else {
            echo "\e[Positions não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }
}
