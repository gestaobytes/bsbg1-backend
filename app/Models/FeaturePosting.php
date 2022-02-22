<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeaturePosting extends Model {

    use SoftDeletes;
    protected $table = 'feature_postings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'post_id',
        'feature_id',
    ];
    
}




