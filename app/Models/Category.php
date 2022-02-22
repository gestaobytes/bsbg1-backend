<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;


class Category extends Model {

    use SoftDeletes;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'type',
        'title',
        'slug',
        'order',
        'icon',
        'description',
        'topcolor',
        'colorsourcetop',
        'linktop',
        'linkfooter',
    ];
    // protected $casts = [
    //     'created_at' = 'Timestamp',
    //     'updated_at' = 'Timestamp',
    //     'deleted_at' = 'Timestamp',
    // ];
    // public $timestamps = false;
}
