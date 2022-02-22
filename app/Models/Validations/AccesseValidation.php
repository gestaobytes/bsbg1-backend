<?php

namespace App\Models\Validations;

class AccesseValidation
{

    public const MENSAGENS_DE_ERRO = [
        'post_id.required' => 'POST não foi preenchido',
        'post_id.numeric' => 'POST deve ser numérico',
   
        'qtd.required' => 'QUANTIDADE não foi preenchido',
        'qtd.numeric' => 'QUANTIDADE deve ser numérico',
    ];

    public const REGRAS_DA_MODEL = [
        'post_id' => "required|numeric",
        'qtd' => "required|numeric",
    ];

}
