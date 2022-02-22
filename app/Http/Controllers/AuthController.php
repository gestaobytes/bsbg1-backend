<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Arr;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{

    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
        $this->middleware('auth:api', ['except' => ['login', 'validateToken', 'register']]);
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|min:4|max:60',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
        ];

        $messages = [
            'name.required' => 'Nome eh obrigatorio',
            'name.min' => 'Nome deve ter no minimo 6 caracteres',
            'name.max' => 'Nome deve ter no maximo 60 caracteres',
            'email.required' => 'O campo E-mail e obrigatorio',
            'email.email' => 'Insira um e-mail valido',
            'email.unique' => 'Este e-mail ja esta em uso',
            'password.required' => 'O campo Senha eh obrigatorio',
            'email.max' => 'E-mail deve ter no maximo 255 caracteres',
            'password.min' => 'A Senha deve ter no minimo 6 caracteres',
        ];

        $validator = validator($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $type = (!isset($request->type) || $request->type == '') ? 'C' : $request->type;


        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'type' => $type
        ]);
        
        $roleId = 3;
        $role = DB::insert('insert into role_user (user_id, role_id) values (?, ?)', [$user->id, $roleId]);


        if ($user && $role) {
            DB::commit();
            // $dados = array(
            //     'email' => "$user->email",
            //     'name' => "$user->name",
            // );
            // Mail::send('restrito.wellcome.index', $dados, function ($message) use ($dados) {
            //     $message->to($dados['email'])->subject('Seja Bem Vindo!');
            // });
        } else {
            DB::rollBack();
        }
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

        $credentials = $request->only('email', 'password');
        if (!$token = $this->jwt->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userLog = Auth::user();
        $user = Auth::user()
            ->select('users.id', 'users.name', 'users.email')
            ->where('id', $userLog->id)
            ->with('roles:roles.id,roles.name')
            ->first();

        // if ($user->status != "ON") {
        //     return response()->json(['message' => 'Usuário bloqueado.']);
        // }

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

        $expires_in = auth()->factory()->getTTL() * 60;
        $type = 3600;

        return response()->json(compact('token', 'type', 'expires_in', 'user', 'permissions'));
    }

    public function me()
    {

        $user = auth()->user()
            ->select('id')
            ->where('id', auth()->user()->id)
            ->first();

        $roles = auth()->user()
            ->select('users.id')
            ->where('id', auth()->user()->id)
            ->with('roles:roles.id,roles.name')
            ->first();

        $idsRoles = Arr::pluck($roles->roles, 'id');

        $permissions = Role::select('roles.id', 'roles.name')
            ->whereIn('roles.id', $idsRoles)
            ->with('permissions:permissions.id,permissions.name')
            ->first();
        $idsPermissions = Arr::pluck($permissions->permissions, 'id');
        $permissions = Permission::select('name')
            ->whereIn('id', $idsPermissions)
            ->get();
        $permissions = Arr::pluck($permissions, 'name');

        $data = [
            'user' => $user,
            'permissions' => $permissions,
        ];

        return response()->json(compact('data'));
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
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
