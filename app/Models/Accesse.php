<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accesse extends Model {

    use SoftDeletes;
    protected $table = 'accesses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'post_id',
        'qtd'
    ];
    
}
