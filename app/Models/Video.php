<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model {

    use SoftDeletes;
    protected $table = 'videos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'post_id',
        'title', 
        'url', 
        'description', 
    ];
   
}
