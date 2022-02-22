<?php

namespace App\Models\Validations;

class PhotoValidation
{

    public const MENSAGENS_DE_ERRO = [
        'post_id.required' => 'POST não foi preenchido',
        'post_id.numeric' => 'POST deve ser numérico',
        
        'name.required' => 'NAME não foi preenchido',
        'name.max' => 'NAME deve ter no máximo :max caracteres',
        
        'credit' => 'CREDIT não foi preenchido',
        'credit.text' => 'CREDIT deve ter no máximo :max caracteres',

    ];

    public const REGRAS_DA_MODEL = [
        'post_id' => "required|numeric",
        'name' => "required|max:80",
        'credit' => "required|max:30",
    ];

}