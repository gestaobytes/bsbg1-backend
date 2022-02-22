<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialMedia extends Model {

    use SoftDeletes;
    protected $table = 'social_media';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'url', 
        'app_id', 
        'app_password', 
    ];
    
}

