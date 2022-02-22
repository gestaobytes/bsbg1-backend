<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\v1\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\v1\_ControlCommon;

class UserController extends Controller
{
    private $service, $commons, $gate;

    public function __construct(UserService $service, _ControlCommon $commons)
    {
        $this->service = $service;
        $this->commons = $commons;
        $this->gate = 'user';
    }

    public function index()
    {
        $this->commons->userAuthorization($this->gate);
        return $this->service->index();
    }

    public function show(int $id)
    {
        $this->commons->userAuthorization($this->gate);
        return $this->service->show($id);
    }

    public function comboBox() {
        return $this->service->comboBox();
    }


    public function details(int $id)
    {
        $this->commons->userAuthorization($this->gate);
        return $this->service->details($id);
    }

    public function store(Request $request)
    {
        $this->commons->userAuthorization($this->gate);
        return $this->service->store($request);
    }

    public function update(int $id, Request $request)
    {
        $this->commons->userAuthorization($this->gate);
        return $this->service->update($id, $request);
    }

    public function image(int $id, Request $request)
    {
        $this->commons->userAuthorization($this->gate);
        return $this->service->image($id, $request);
    }

    public function delete(int $id)
    {
        $this->commons->userAuthorization($this->gate);
        return $this->service->delete($id);
    }

    public function trash()
    {
        $this->commons->userAuthorization($this->gate);
        return $this->service->trash();
    }

    public function restore(int $id)
    {
        $this->commons->userAuthorization($this->gate);
        return $this->service->restore($id);
    }

}
