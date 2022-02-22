<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Post extends Seeder
{
    public function run()
    {
        factory('App\Models\Post', 200)->create();
    }
}
