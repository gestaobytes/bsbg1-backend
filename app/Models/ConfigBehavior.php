<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfigBehavior extends Model {

    use SoftDeletes;
    protected $table = 'config_behaviors';
    protected $primaryKey = 'id';
    protected $fillable = [
        'urlmethod',
        'votewithoutregistration',
        'selfapproval',
        'autolistinghome',
        'autoloadconfig',
    ];
}

