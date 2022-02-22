<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\v1\ReactionPostService;
use Illuminate\Http\Request;

class ReactionPostController extends Controller
{

    private $service;

    public function __construct(ReactionPostService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show(int $id)
    {
        return $this->service->show($id);
    }

    public function details(int $id)
    {
        return $this->service->details($id);
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function update(int $id, Request $request)
    {
        return $this->service->update($id, $request);
    }

    public function delete(int $id)
    {
        return $this->service->delete($id);
    }

    public function trash()
    {
        return $this->service->trash();
    }

    public function restore(int $id)
    {
        return $this->service->restore($id);
    }
}
