<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\v1\_HomeService;
use Illuminate\Http\Request;

class _HomeController extends Controller
{
    private $service;

    public function __construct(_HomeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function post01()
    {
        // return $this->service->post01();
    }

}
