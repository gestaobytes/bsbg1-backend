<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialColumn extends Model {

    use SoftDeletes;
    protected $table = 'social_columns';
    protected $primaryKey = 'id';
    protected $fillable = [
        'event_id',
        'title', 
        'note', 
        'tags', 
        'slug', 
    ];
}

