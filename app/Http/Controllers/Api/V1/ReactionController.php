<?php

 namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\v1\ReactionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\v1\_ControlCommon;

class ReactionController extends Controller {

    private $service, $commons, $gate;

    public function __construct(ReactionService $service, _ControlCommon $commons) {
        $this->service = $service;
        $this->commons = $commons;
        $this->gate = 'reaction';
    }

    public function index() {
        $this->commons->userAuthorization($this->gate);
        return $this->service->index();
    }

    public function show(int $id) {
        $this->commons->userAuthorization($this->gate);
        return $this->service->show($id);
    }

    public function details(int $id) {
        $this->commons->userAuthorization($this->gate);
        return $this->service->details($id);
    }

    public function store(Request $request) {
        $this->commons->userAuthorization($this->gate);
        return $this->service->store($request);
    }

    public function update(int $id, Request $request) {
        $this->commons->userAuthorization($this->gate);
        return $this->service->update($id, $request);
    }

    public function delete(int $id) {
        $this->commons->userAuthorization($this->gate);
        return $this->service->delete($id);
    }

    public function trash() {
        $this->commons->userAuthorization($this->gate);
        return $this->service->trash();
    }

    public function restore(int $id) {
        $this->commons->userAuthorization($this->gate);
        return $this->service->restore($id);
    }

}