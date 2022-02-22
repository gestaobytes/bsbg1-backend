<?php

namespace App\Models;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
	use Notifiable;
	use SoftDeletes;
	protected $table = 'users';
	protected $primaryKey = 'id';
	protected $fillable = [

        'registration',
        'name',
        'genre',
        'birthday',
        'cpf',
        'rg',
        'image',
        'status',
        'phone',
        'cellphone',
        'cellphone2',
        'email',
        'password',
        'type',

	];


	public function roles()
	{
		return $this->belongsToMany(Role::class)->withPivot('id');
	}

	public function permissions()
	{
		return $this->hasManyThrough(Permission::class, Role::class);
	}


	protected $hidden = [
		'password',
	];

	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	public function getJWTCustomClaims()
	{
		return [];
	}
}
