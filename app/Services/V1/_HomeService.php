<?php

namespace App\Services\v1;

use App\Interfaces\v1\_HomeInterface;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Validation\ValidatesRequests;

class _HomeService
{

    private $interface;
    private $validation;

    public function __construct(_HomeInterface $interface)
    {
        $this->interface = $interface;
    }

    public function index()
    {
        try {
            $interface = $this->interface->index();

            if (count($interface) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json([], Response::HTTP_OK);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function post01()
    {
        try {
            $interface = $this->interface->post01();

            if (count($interface) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json([], Response::HTTP_OK);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    
}
