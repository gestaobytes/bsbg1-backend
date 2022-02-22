<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {

    use SoftDeletes;
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'subcategory_id',
        'position_id',
        'user_id',
        'retracts',
        'title',
        'titleadapter',
        'slug',
        'subtitle',
        'text',
        'image',
        'image_credit',
        'image_subtitle',
        'tags',
        'status',
        'date_start',
        'will_restrict_users',
    ];


    public function accesses()
    {
        return $this->hasMany(Accesse::class);
    }




}


