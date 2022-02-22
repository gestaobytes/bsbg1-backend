<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;

    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'label'];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

}
