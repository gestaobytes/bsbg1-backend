<?php

namespace App\Repositories\v1;

use App\Models\SubCategory;
use App\Interfaces\v1\SubCategoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryRepository implements SubCategoryInterface
{
    private $model, $request;

    public function __construct(SubCategory $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function index()
    {
        $dts = isset($_GET['dts']) ? $_GET['dts'].' 00:00:00' : '2010-01-01 00:00:00';
        $dtf = isset($_GET['dtf']) ? $_GET['dtf'].' 00:00:00' : date('Y-m-d').' 23:59:59';
        $keywordsSearch = isset($_GET['q']) ? $_GET['q'] : "";
        $keywords = $keywordsSearch;

        $pgLimit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        $sortField = isset($_GET['sort']) ? $_GET['sort'] : '-subcategories.id';
        $fieldsToSelect = isset($_GET['fields']) ? $_GET['fields'] : 'subcategories.id,subcategories.title,subcategories.description,categories.title as category';

        $sortField = explode(",", $sortField);
        $fieldsToSelect = explode(',', $fieldsToSelect);
        $qtdSort = count($sortField);

        $orderBy = "";
        for ($i = 0; $i < $qtdSort; $i++) {
            $sinal = substr($sortField[$i], 0, 1);
            $orderBy .= ($sinal == '-') ? substr($sortField[$i], 1) . " desc," : "$sortField[$i] asc,";
        }
        $orderBy = rtrim($orderBy, ',');

        $data = $this->model->select($fieldsToSelect)
            ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
            ->whereBetween('subcategories.created_at', [$dts, $dtf]);

        if (isset($keywords) && $keywords != '') {
            $keywords = explode(" ", $keywords);
            $qtd = count($keywords);
            $search = "";
            for ($i = 0; $i < $qtd; $i++) {
                $search .= "(subcategories.title like '%$keywords[$i]%' or subcategories.description like '%$keywords[$i]%' or categories.title like '%$keywords[$i]%') or ";
            }
            $search = rtrim($search, ' or ');
            $data->whereRaw("($search)");
        }

        // $data = $data->orderByRaw($orderBy)->toSql();
        // dd($data);
        return $data->orderByRaw($orderBy)->paginate($pgLimit);
    }

    public function comboBox()
    {
        return $this->model
            ->leftJoin('categories', 'categories.id', 'subcategories.category_id')
            ->select('subcategories.id', 'subcategories.title', 'categories.title as titleCategory')
            ->orderBy('titleCategory', 'asc')
            ->orderBy('title', 'asc')
            ->get();
    }

    public function show(int $id)
    {
        return $this->model->where('id', $id)->get();
    }

    public function details(int $id)
    {
        return $this->model->find($id);
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $slug = array('slug' => Str::slug($dataForm['title'], '-'));
        $dataForm = array_merge($dataForm, $slug);
        return $this->model->create($dataForm);
    }

    public function update(int $id, Request $request)
    {
        $dataForm = $request->all();
        $slug = array('slug' => Str::slug($dataForm['title'], '-'));
        $dataForm = array_merge($dataForm, $slug);
        unset($dataForm['created_at'], $dataForm['updated_at'], $dataForm['deleted_at']);
        return $this->model->where('id', $id)->update($dataForm);
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


    // public function users(int $id) {
    //     return $this->model
    //         ->where('id', $id)
    //         ->select('id', 'name')
    //         ->with('users:id,user_id,name')
    //         ->get();
    // }
}
