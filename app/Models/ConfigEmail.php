<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfigEmail extends Model {

    use SoftDeletes;
    protected $table = 'config_emails';
    protected $primaryKey = 'id';
    protected $fillable = [
        'address',
        'driver',
        'host',
        'port',
        'username',
        'password',
        'encryption',
    ];
}

