<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Columner extends Model {

    use SoftDeletes;
    protected $table = 'columners';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'blog_id',
        'description',
        'facebook',
        'twitter',
        'google',
        'linkedin',
    ];
}
