<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wishe extends Model {

    use SoftDeletes;
    protected $table = 'wishes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'option_id',
        'ip', 
        'qtd', 
    ];
}

