<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (DB::table('subcategories')->get()->count() == 0) {
            DB::table('subcategories')->insert([
                [
                    'category_id' => 1,
                    'title' => 'Tocantins',
                    'slug' => 'tocantins',
                    'description' => 'Editoria de Tocantins',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'category_id' => 1,
                    'title' => 'Palmas',
                    'slug' => 'palmas',
                    'description' => 'Editoria de Palmas',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'category_id' => 1,
                    'title' => 'Brasil',
                    'slug' => 'brasil',
                    'description' => 'Editoria de Brasil',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'category_id' => 2,
                    'title' => 'Olimpíadas',
                    'slug' => 'olimpiadas',
                    'description' => 'Editoria de Olimpíadas',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'category_id' => 2,
                    'title' => 'Copa do Mundo 2022',
                    'slug' => 'copa-do-mundo-2022',
                    'description' => 'Editoria de Copa do Mundo 2022',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'category_id' => 3,
                    'title' => 'Religião',
                    'slug' => 'religiao',
                    'description' => 'Religião',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                
              
                
            ]);
        } else {
            echo "\e[31mSubCategories não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }
}
