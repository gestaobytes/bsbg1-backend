<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mail\AuthEmail;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Arr;
use App\Models\Role;
use App\Models\Layout;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Mail\RegisterUser;


class AuthController extends Controller
{

    protected $jwt;
    private $user, $request;

    public function __construct(JWTAuth $jwt, User $user, Request $request)
    {
        $this->jwt = $jwt;
        $this->user = $user;
        $this->request = $request;
        $this->middleware('auth:api', ['except' => ['login', 'validateToken', 'register', 'resetPassword']]);
    }

    public function resetPassword(Request $request)
    {

        $rules = [
            'email' => 'required|email|max:255',
        ];

        $messages = [
            'email.required' => 'O campo E-mail e obrigatorio',
            'email.email' => 'Insira um e-mail valido',
            'email.max' => 'E-mail deve ter no maximo 255 caracteres',
        ];

        $validator = validator($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $verifyUser = User::where('email', $request->email)->first();


        if ($verifyUser != null) {

            $company = 'Prefeitura de Porto Nacional';
            $email = 'contato@portonacional.to.gov.br';

            $str = '@!*-%$0123456789AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuWwVvXxYyzz';
            $mix = str_shuffle($str);
            $pass = substr($mix, 4, 8);

            $password = ['password' => $pass];

            $company = [
                'name' => $company,
                'email' => $email,
                'domain' => 'portonacional.to.gov.br',
            ];

            $update = $this->user->where('id', $verifyUser->id)->update(['password' => bcrypt($pass)]);

            // if($update){
            //     Mail::to($request->email)->send(new RegisterUser($company, $verifyUser, $password));
            // }

        } else {
            return ['error' => 'O e-mail informado nao esta cadastrado'];
        }
    }


    public function login(Request $request)
    {

        $this->validate(
            $request,
            [
                'email' => 'required|email|max:255',
                'password' => 'required|min:6',
            ],
            [
                'email.required' => 'O campo E-mail e obrigatorio',
                'email.email' => 'Insira um e-mail valido',
                'email.max' => 'E-mail deve ter no maximo 255 caracteres',
                'password.required' => 'O campo Senha e obrigatorio',
                'password.min' => 'A Senha deve ter no minimo 6 caracteres',
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


        $idsRoles = Arr::pluck($user->roles, 'id');
        $permissions = Role::select('roles.id', 'roles.name')
            ->whereIn('roles.id', $idsRoles)
            ->with('permissions:permissions.id,permissions.name')
            ->first();
        if ($permissions != null) {
            $idsPermissions = Arr::pluck($permissions->permissions, 'id');
            $permissions = Permission::select('name')
                ->whereIn('id', $idsPermissions)
                ->get();
            $permissions = Arr::pluck($permissions, 'name');
        } else {
            $permissions = [];
        }

        // $expires_in = auth()->factory()->getTTL() * 60;
        $dateNow = Carbon::now();
        $expires_in = Carbon::parse($dateNow)->addMinutes(60)->format('Y-m-d H:i:s');
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
