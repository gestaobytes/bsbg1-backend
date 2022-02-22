<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model {

    use SoftDeletes;
    protected $table = 'banners';
    protected $primaryKey = 'id';
    protected $fillable = [
        'positionbanner_id',
        'url',
        'order',
        'start',
        'end',
        'name',
        'image',
    ];

}
