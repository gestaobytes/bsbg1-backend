<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrintedVersion extends Model {

    use SoftDeletes;
    protected $table = 'printed_versions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'number',
        'date', 
        'pdf', 
        
    ];
    
}
