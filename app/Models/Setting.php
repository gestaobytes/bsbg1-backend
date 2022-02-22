<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model {

    use SoftDeletes;
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'websitename',
        'toplogo', 
        'logofooter', 
        'favicon', 
        'metatitle', 
        'metadescription', 
        'metakeywords', 
        'termsofuse', 
        'codgoogle', 
        'urlapp', 
        'passwordapp', 
    ];
  
}
