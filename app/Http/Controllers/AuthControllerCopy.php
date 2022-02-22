<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Arr;
use App\Models\Role;
use App\Models\Permission;

class AuthControllerCopy extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','validateToken']]);
    }

    public function login(Request $request)
    {
        $this->validate(
            $request,
            [
                'email'    => 'required|email|max:255',
                'password' => 'required|min:6',
            ],
            [
                'email.required' => 'E-MAIL: campo obrigatório',
                'email.email' => 'E-MAIL: insira um e-mail válido',
                'password.required' => 'SENHA: campo obrigatório',
                'email.max' => 'E-MAIL: máximo de 255 caracteres',
                'password.min' => 'SENHA: mínimo de 6 caracteres',
            ]
        );

        $credentials = request(['email', 'password']);
        if (!$token = Auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userLoged = Auth::user();
        $user = Auth::user()
        ->select('users.id', 'users.name', 'users.status')
        ->where('id', $userLoged->id)
        ->with('roles:roles.id,roles.name')
        ->first();

         if ($user->status != "ON") {
            return response()->json(['message' => 'Usuário bloqueado.']);
        }

        $idsRoles = Arr::pluck($user->roles, 'id');
        $permissions = Role::select('roles.id', 'roles.name')
            ->whereIn('roles.id', $idsRoles)
            ->with('permissions:permissions.id,permissions.name')
            ->first();
        $idsPermissions = Arr::pluck($permissions->permissions, 'id');
        $permissions = Permission::select('name')
            ->whereIn('id', $idsPermissions)
            ->get();
        $permissions = Arr::pluck($permissions, 'name');
        // return response()->json(compact('token', 'user', 'permissions'));
        return $this->respondWithToken($token, $user, $permissions);
    }

    public function me()
    {
        return response()->json(Auth()->user());
    }

    public function logout()
    {
        Auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth()->refresh());
    }

    protected function respondWithToken($token, $user, $permissions)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth()->factory()->getTTL() * 60,
            'user' => $user,
            'permissions' => $permissions,
        ]);
    }

    public function validateToken(Request $request)
    {
        try {
            if ($request) {
                return response()->json([
                    'access_token' => $request,
                    'token_type' => 'bearer',
                ]);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error', 'token_invalid'], "invalid");
        }
    }
}
