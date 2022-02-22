<?php

namespace App\Repositories\v1;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\v1\UserInterface;
use App\Models\Validations\UserValidation;
use Symfony\Component\HttpFoundation\Response;

class UserRepository implements UserInterface
{
    private $model;
    private $request;
    private $validation;

    public function __construct(User $model, Request $request, UserValidation $validation)
    {
        $this->model = $model;
        $this->request = $request;
        $this->validation = $validation;
    }

    public function index()
    {
        $dts = isset($_GET['dts']) ? $_GET['dts'].' 00:00:00' : '2010-01-01 00:00:00';
        $dtf = isset($_GET['dtf']) ? $_GET['dtf'].' 00:00:00' : date('Y-m-d').' 23:59:59';
        $keywordsSearch = isset($_GET['q']) ? $_GET['q'] : "";
        $keywords = $keywordsSearch;

        $pgLimit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        $sortField = isset($_GET['sort']) ? $_GET['sort'] : '-users.id,users.name,users.type';
        $fieldsToSelect = isset($_GET['fields']) ? $_GET['fields'] : 'users.id,users.name,users.image,users.phone,users.cellphone,users.email,users.type';

        $sortField = explode(",", $sortField);
        $fieldsToSelect = explode(',', $fieldsToSelect);
        $qtdSort = count($sortField);

        $orderBy = "";
        for ($i = 0; $i < $qtdSort; $i++) {
            $sinal = substr($sortField[$i], 0, 1);
            $orderBy .= ($sinal == '-') ? substr($sortField[$i], 1) . " desc," : "$sortField[$i] asc,";
        }
        $orderBy = rtrim($orderBy, ',');


        $data = $this->model->select($fieldsToSelect)->whereBetween('users.created_at', [$dts, $dtf])
        ->with('roles:roles.id as role_id,roles.name as role');

        if (isset($keywords) && $keywords != '') {
            $keywords = explode(" ", $keywords);
            $qtd = count($keywords);
            $search = "";
            for ($i = 0; $i < $qtd; $i++) {
                // $search .= "(name like '%$keywords[$i]%') or (description like '%$keywords[$i]%') or ";
                $search .= "(users.name like '%$keywords[$i]%') or ";
            }
            $search = rtrim($search, ' or ');
            $data->whereRaw("($search)");
        }

        return $data->orderByRaw($orderBy)->where('users.id', '<>', 1)->paginate($pgLimit);

    }

    public function comboBox()
    {
        return $this->model->select('id','name')->orderBy('name')->get();
    }

    // public function image(int $id, Request $request) {
    //     return "";
    // }

    public function show(int $id)
    {
        return $this->model->where('id', $id)->get();
    }

    public function details(int $id)
    {
        return $this->model->where('users.id', $id)
            ->first();
    }

    public function store(Request $request)
    {
        $dataForm = $this->request->all();

        if (isset($dataForm['password'])) {
            $password = array('password' => bcrypt($dataForm['password']));
            $dataForm = array_merge($dataForm, $password);
        }
        if (!isset($dataForm['type'])) {
            $type = array('type' => 'Servidor');
            $dataForm = array_merge($dataForm, $type);
        }

        return $this->model->create($dataForm);
    }

    public function update(int $id, Request $request)
    {
        $capturePassword = $this->model->select('password')->where('id', $id)->first();
        $dataForm = $this->request->all();

        if (isset($dataForm['password']) && $dataForm['password'] != '') {
            $password = array('password' => bcrypt($dataForm['password']));
            $dataForm = array_merge($dataForm, $password);
        } else {
            $password = array('password' => $capturePassword->password);
            $dataForm = array_merge($dataForm, $password);
        }
        if (!isset($dataForm['type'])) {
            $type = array('type' => 'Servidor');
            $dataForm = array_merge($dataForm, $type);
        }
        unset($dataForm['created_at'],$dataForm['updated_at'],$dataForm['deleted_at']);

        $validacao = Validator::make(
            $dataForm,
            $this->validation::REGRAS_DA_MODEL,
            $this->validation::MENSAGENS_DE_ERRO
        );

        if ($validacao->fails()) {
            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            try {

                $interface = $this->model->where('id', $id)->update($dataForm);
                return response()->json($interface, Response::HTTP_CREATED);
            } catch (QueryException $e) {
                return response()->json(['msg' => 'Erro de conexão com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }







    }

    public function image(int $id, Request $request)
    {
        $user = $this->model->select('id','name','image')->find($id);
        $nameFile = Str::slug($user->name, '-');
        $nameFile = "$nameFile-UIIJ$id";

        if (isset($request['image']) && $request['image'] != "") {
            $img = $request['image'];
            unset($request['image']);
            unset($request['id']);

            $imageInfo = explode(";base64,", $img);
            $extension = str_replace('data:image/', '', $imageInfo[0]);
            $img = str_replace("data:image/$extension;base64,", '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $image = Image::make($data)->encode('jpg');

            $image->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $nameFile = "$nameFile.jpg";
            $image->fit('400', '400');
            $image->save(Storage::disk('gcs')->put("users/$nameFile", "$image"));
        } else {
            $nameFile = $user->image;
        }

        return $this->model->where('id', $id)->update(['image' => "$nameFile"]);
    }

    public function delete(int $id)
    {
        $model = $this->model->find($id);
        return $model->delete();
    }

    public function trash()
    {
        return $this->model->onlyTrashed()->get();
    }

    public function restore(int $id)
    {
        return $this->model->withTrashed()
            ->where('id', $id)
            ->restore();
    }

}
