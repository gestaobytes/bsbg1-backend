<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PositionBanner extends Model {

    use SoftDeletes;
    protected $table = 'position_banners';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
    ];   
}
