<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use SoftDeletes;
    protected $table = 'features';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'question',
        'date_register',
        'date_start',
        'date_end',
        'situation',
    ];
}
