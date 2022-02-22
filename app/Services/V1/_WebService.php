<?php

namespace App\Services\v1;

use App\Interfaces\v1\_WebInterface;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Validation\ValidatesRequests;

class _WebService
{

    private $interface;
    private $validation;

    public function __construct(_WebInterface $interface)
    {
        $this->interface = $interface;
    }

    public function post($category, $post)
    {
        try {
            $interface = $this->interface->post($category, $post);

            if (isset($interface) && $interface != null) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function reactions()
    {
        try {
            $interface = $this->interface->reactions();

            if (count($interface) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function reactionPost($id)
    {
        try {
            $interface = $this->interface->reactionPost($id);

            if (count($interface) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json(['msg' => 'Nenhum dado registrado'], Response::HTTP_OK);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function pollReactionPost($post, $reaction)
    {
        try {
            $interface = $this->interface->pollReactionPost($post, $reaction);
            return response()->json($interface, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexão com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    public function category($category)
    {
        try {
            $interface = $this->interface->category($category);

            if (count($interface) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function categories()
    {
        try {
            $interface = $this->interface->categories();

            if (count($interface) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function tag($tag)
    {
        try {
            $interface = $this->interface->tag($tag);

            if (count($interface) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function editais($id, $edital)
    {
        try {
            $interface = $this->interface->editais($id, $edital);
            return response()->json($interface, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexão com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function lastsPostsCategory($category)
    {
        try {
            $interface = $this->interface->lastsPostsCategory($category);

            if (count($interface) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function lastsPosts()
    {
        try {
            $interface = $this->interface->lastsPosts();

            if (count($interface) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function mostAccessedDay()
    {
        try {
            $interface = $this->interface->mostAccessedDay();

            if (count($interface) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json(null, Response::HTTP_OK);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function mostAccessedWeek()
    {
        try {
            $interface = $this->interface->mostAccessedWeek();

            if (count($interface) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function allPosts()
    {
        try {
            $interface = $this->interface->allPosts();

            if (count($interface) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function allPostsAllTime()
    {
        try {
            $interface = $this->interface->allPostsAllTime();

            if (count($interface) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function fixedPosts()
    {
        try {
            $interface = $this->interface->fixedPosts();

            if (count($interface) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

   

    public function lastsBanners()
    {
        try {
            $interface = $this->interface->lastsBanners();

            if (count($interface) > 0) {
                return response()->json($interface, Response::HTTP_OK);
            } else {
                return response()->json(null, Response::HTTP_NOT_FOUND);
            }
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexao com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function search(Request $request)
    {
        try {
            $interface = $this->interface->search($request);
            return response()->json($interface, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Erro de conexão com o banco'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
