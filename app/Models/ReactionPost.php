<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReactionPost extends Model {

    use SoftDeletes;
    protected $table = 'reaction_posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'post_id',
        'reaction_id',
        'ip',
        'votes',
    ];

}

