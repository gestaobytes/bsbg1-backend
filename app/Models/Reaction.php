<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reaction extends Model {

    use SoftDeletes;
    protected $table = 'reactions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'slug',
        'emoction', 
        'status', 
    ];
    
}

