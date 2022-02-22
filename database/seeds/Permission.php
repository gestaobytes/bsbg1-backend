<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Permission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (DB::table('permissions')->get()->count() == 0) {
            DB::table('permissions')->insert([

                /* permissão gral de administrador (ADMIN) */
                [
                    'id' => 1,
                    'name' => 'super',
                    'label' => 'Perfil implantador Gestão Bytes.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                /* permissão gral de administrador (ADMIN) */
                [
                    'id' => 2,
                    'name' => 'Administrador',
                    'label' => 'Gerenciamento geral das funcionalidades do sistema.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 3,
                    'name' => 'article',
                    'label' => 'Gerenciamento de artigos correlatos ao Post.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 4,
                    'name' => 'banner',
                    'label' => 'Gerenciamento dos anúncios.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 5,
                    'name' => 'blog',
                    'label' => 'Gerenciamento dos Blogs.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 6,
                    'name' => 'category',
                    'label' => 'Gerenciamento das Categorias.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 7,
                    'name' => 'columner',
                    'label' => 'Gerenciamento dos Colunistas.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 8,
                    'name' => 'company',
                    'label' => 'Gerenciamento da(s) Empresa(s).',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 9,
                    'name' => 'configbehavior',
                    'label' => 'Gerenciamento dos Boletos.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 10,
                    'name' => 'configemail',
                    'label' => 'Gerenciamento dos Emails.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 11,
                    'name' => 'event',
                    'label' => 'Gerenciamento dos Eventos da Coluna Social.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 12,
                    'name' => 'feature',
                    'label' => 'Gerenciamento das Configurações.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 13,
                    'name' => 'featureposting',
                    'label' => 'Gerenciamento das Configurações dos Posts.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 14,
                    'name' => 'layout',
                    'label' => 'Gerenciamento dos Layouts.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 15,
                    'name' => 'option',
                    'label' => 'Gerenciamento das Opções das Enquetes.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 16,
                    'name' => 'permission',
                    'label' => 'Gerenciamento das Permissões (ACL).',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 17,
                    'name' => 'photo',
                    'label' => 'Gerenciamento das Imagens da Coluna Social.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 18,
                    'name' => 'positionbanner',
                    'label' => 'Gerenciamento das Posições dos Anúncios.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 19,
                    'name' => 'position',
                    'label' => 'Gerenciamento das Posições das Posagens.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 20,
                    'name' => 'post',
                    'label' => 'Gerenciamento dos Posts.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 21,
                    'name' => 'printedversion',
                    'label' => 'Gerenciamento das Versões Impressas.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 22,
                    'name' => 'reaction',
                    'label' => 'Gerenciamento das Reações.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 23,
                    'name' => 'role',
                    'label' => 'Gerenciamento dos Perfis de Usuários (ACL).',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 24,
                    'name' => 'setting',
                    'label' => 'Gerenciamento das Configurações.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 25,
                    'name' => 'socialcolumn',
                    'label' => 'Gerenciamento da Coluna Social.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 26,
                    'name' => 'socialmedia',
                    'label' => 'Gerenciamento das Midias Sociais.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 27,
                    'name' => 'subcategory',
                    'label' => 'Gerenciamento das Subcategorias.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 28,
                    'name' => 'wishe',
                    'label' => 'Gerenciamento das Solicitações.',
                    'created_at' => date('Y-m-d H:i:s'),
                ],


            ]);
        } else {
            echo "\e[31mPermission não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }
}
