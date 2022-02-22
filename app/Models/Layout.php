<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layout extends Model {
    
    use SoftDeletes;
    protected $table = 'layouts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'standardfontcolor',
        'colortop',
        'colorsourcetop',
        'colorfooter',
        'colorsourcefooter',
        'status',
        'image',
    ];
}

