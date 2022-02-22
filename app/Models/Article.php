<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model {
    use SoftDeletes;
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'post_id',
        'title',
        'text'
    ];
    
}
