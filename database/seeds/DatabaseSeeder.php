<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {

    public function run() {
        $this->call('User');
        $this->call('Role');
        $this->call('Permission');
        $this->call('PermissionRole');
        $this->call('RoleUser');
        $this->call('Category');
        $this->call('SubCategory');
        $this->call('Position');
        $this->call('Post');
        $this->call('Accesse'); 
        $this->call('Reaction');
    }

}