<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;

class _ControlCommon extends BaseController
{

    private $auth;
    private $user;

    public function __construct(Auth $auth, User $user)
    {
        $this->auth = $auth;
        $this->user = $user;
    }

    public function userAuthorization($gate)
    {
        $roleIrresctrict = 'super';
        $idUserLogin = Auth::user()->id;
        $dataUser = $this->user::with('roles')->select('id')->find($idUserLogin);
        $roles = $dataUser->roles;
        $roles = Arr::pluck($roles, 'id'); // ids roles
        $permissionsUser = Role::with('permissions')->whereIn('id', $roles)->select('id')->get();
        $permissionsUser = Arr::pluck($permissionsUser, 'permissions');
        $permissionsUser = Arr::collapse($permissionsUser);
        $permissionsUser = Arr::pluck($permissionsUser, 'name');

        if ((!in_array($gate, $permissionsUser)) && (!in_array($roleIrresctrict, $permissionsUser)) ) {
            abort(403, 'Não Autorizado!');
        }
    }
}
