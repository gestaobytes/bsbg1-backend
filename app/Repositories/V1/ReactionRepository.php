<?php

namespace App\Repositories\v1;

use App\Models\Reaction;
use App\Interfaces\v1\ReactionInterface;
use Illuminate\Http\Request;

class ReactionRepository implements ReactionInterface {
    private $model, $request;

    public function __construct(Reaction $model, Request $request) {
        $this->model = $model;
        $this->request = $request;
    }

    public function index()
    {
        $dts = isset($_GET['dts']) ? $_GET['dts'].' 00:00:00' : '2010-01-01 00:00:00';
        $dtf = isset($_GET['dtf']) ? $_GET['dtf'].' 00:00:00' : date('Y-m-d').' 23:59:59';
        $keywordsSearch = isset($_GET['q']) ? $_GET['q'] : "";
        $keywords = $keywordsSearch;

        $pgLimit = isset($_GET['limit']) ? $_GET['limit'] : 100;
        $sortField = isset($_GET['sort']) ? $_GET['sort'] : '-id,slug';
        $fieldsToSelect = isset($_GET['fields']) ? $_GET['fields'] : 'id,slug,emoction';

        $sortField = explode(",", $sortField);
        $fieldsToSelect = explode(',', $fieldsToSelect);
        $qtdSort = count($sortField);

        $orderBy = "";
        for ($i = 0; $i < $qtdSort; $i++) {
            $sinal = substr($sortField[$i], 0, 1);
            $orderBy .= ($sinal == '-') ? substr($sortField[$i], 1) . " desc," : "$sortField[$i] asc,";
        }
        $orderBy = rtrim($orderBy, ',');

        $model = $this->model->select($fieldsToSelect)->whereBetween('created_at', [$dts, $dtf]);

        if (isset($keywords) && $keywords != '') {
            if (isset($_GET['e']) && ($_GET['e'] == 'yes')) {
                $search = "(slug like '%$keywords%')";
                $model->whereRaw("($search)");
            } else {
                $keywords = explode(" ", $keywords);
                $qtd = count($keywords);
                $search = "";
                for ($i = 0; $i < $qtd; $i++) {
                    $search .= "(slug like '%$keywords[$i]%') or ";
                }
                $search = rtrim($search, ' or ');
                $model->whereRaw("($search)");
            }
        }

        return $model->orderByRaw($orderBy)->paginate($pgLimit);
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
