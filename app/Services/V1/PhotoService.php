<?php

namespace App\Services\v1;

use App\Interfaces\v1\PhotoInterface;
use App\Models\Validations\PhotoValidation;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Validation\ValidatesRequests;

class PhotoService {

    private $interface;
    private $validation;

    public function __construct(PhotoInterface $interface, PhotoValidation $validation) {
        $this->interface = $interface;
        $this->validation = $validation;
    }

    public function index() {
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

    public function show($id) {
        try {
            $interface = $this->interface->show($id);

            if (count($interface) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function details($id) {
        try {
            $qtd = $this->interface->show($id);
            /** atenção para o SHOW */
            $interface = $this->interface->details($id);
            /** atenção para o DETAILS */

            if (count($qtd) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request) {
        $validacao = Validator::make(
            $request->all(),
            $this->validation::REGRAS_DA_MODEL,
            $this->validation::MENSAGENS_DE_ERRO
        );

        if ($validacao->fails()) {
            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            try {
                $interface = $this->interface->store($request);
                return response()->json($interface, Response::HTTP_CREATED);
            } catch (QueryException $e) {
                return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function update(int $id, Request $request) {
        $validacao = Validator::make(
            $request->all(),
            $this->validation::REGRAS_DA_MODEL,
            $this->validation::MENSAGENS_DE_ERRO
        );

        if ($validacao->fails()) {
            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            try {
                $interface = $this->interface->update($id, $request);
                return response()->json($interface, Response::HTTP_OK);
            } catch (QueryException $e) {
                return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function delete($id) {
        try {
            $interface = $this->interface->delete($id);
            return response()->json(null, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function trash() {
        try {
            $qtd = $this->interface->index();
            /** atenção para o INDEX */
            $interface = $this->interface->trash();
            /** atenção para o TRASH */

            if (count($qtd) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json([], Response::HTTP_OK);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function restore($id) {
        try {
            $interface = $this->interface->restore($id);
            return response()->json(null, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // public function departments($id) {
    //     try {
    //         $interface = $this->interface->show($id);

    //         if (count($interface) > 0) {
    //             // repito essa daqui pq a de cima precisa fazer uma verificação se existe o orgao
    //             $interface = $this->interface->departments($id);
    //             return response()->json($interface, Response::HTTP_OK);
    //         } else {
    //             return response()->json(null, Response::HTTP_NOT_FOUND);
    //         }
    //     } catch (QueryException $e) {
    //         return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }
}
