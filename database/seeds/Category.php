<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (DB::table('categories')->get()->count() == 0) {
            DB::table('categories')->insert([
                [
                    'id' => 1,
                    'type' => 'E',
                    'title' => 'Política',
                    'slug' => 'politica',
                    'icon' => '',
                    'description' => 'Editoria de Política',
                    'topcolor' => 'FFF',
                    'colorsourcetop' => 'FFF',
                    'linktop' => 1,
                    'linkfooter' => 0,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'id' => 2,
                    'type' => 'E',
                    'title' => 'Esporte',
                    'slug' => 'esporte',
                    'icon' => '',
                    'description' => 'Editoria de Esporte',
                    'topcolor' => 'FFF',
                    'colorsourcetop' => 'FFF',
                    'linktop' => 1,
                    'linkfooter' => 0,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'id' => 3,
                    'type' => 'E',
                    'title' => 'Cultura',
                    'slug' => 'cultura',
                    'icon' => '',
                    'description' => 'Editoria de Cultura',
                    'topcolor' => 'FFF',
                    'colorsourcetop' => 'FFF',
                    'linktop' => 1,
                    'linkfooter' => 0,
                    'created_at' => date('Y-m-d H:i:s')
                ],
              
                
            ]);
        } else {
            echo "\e[31mCategories não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }
}
