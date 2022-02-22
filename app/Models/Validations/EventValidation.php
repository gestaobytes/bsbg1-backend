<?php

namespace App\Models\Validations;

class EventValidation
{

    public const MENSAGENS_DE_ERRO = [
        'title.required' => 'TITLE não foi preenchido',
        'title.max' => 'TITLE deve ter no máximo :max caracteres',

    ];

    public const REGRAS_DA_MODEL = [
        'title' => 'required|max:120',
    ];

}