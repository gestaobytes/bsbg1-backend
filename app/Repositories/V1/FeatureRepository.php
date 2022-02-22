<?php

namespace App\Repositories\v1;

use App\Models\Feature;
use App\Interfaces\v1\FeatureInterface;
use Illuminate\Http\Request;

class FeatureRepository implements FeatureInterface {
    private $model, $request;

    public function __construct(Feature $model, Request $request) {
        $this->model = $model;
        $this->request = $request;
    }

    public function index()
    {
        $keywords = $this->request->input('search');
        $keywords = explode(" ", $keywords);
        $qtd = count($keywords);
        $i = 0;
        $search = "";
        while ($i < $qtd) {
            $search .= "name like '%$keywords[$i]%' and ";
            $i++;
        }
        $search = ucfirst(rtrim($search, ' and '));

        return $this->model
            ->orderBy('id', 'desc')
            ->whereRaw("($search)")
            ->paginate(10);
    }

    public function comboBox() {
        return $this->model->select('id', 'name')->get();
    }

    public function show(int $id) {
        return $this->model->where('id', $id)->get();
    }

    public function details(int $id) {
        return $this->model->find($id);
    }

    public function store(Request $request) {
        return $this->model->create($request->all());
    }

    public function update(int $id, Request $request) {
        $dataForm = $request->all();
        unset($dataForm['created_at'],$dataForm['updated_at'],$dataForm['deleted_at']);
        return $this->model->where('id', $id)->update($dataForm);
    }

    public function delete(int $id) {
        $model = $this->model->find($id);
        return $model->delete();
    }

    public function trash() {
        return $this->model->onlyTrashed()->get();
    }

    public function restore(int $id) {
        return $this->model->withTrashed()
            ->where('id', $id)
            ->restore();
    }


    // public function users(int $id) {
    //     return $this->model
    //         ->where('id', $id)
    //         ->select('id', 'name')
    //         ->with('users:id,user_id,name')
    //         ->get();
    // }
}
