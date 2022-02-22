<?php

namespace App\Models\Validations;

class PositionValidation
{

    public const MENSAGENS_DE_ERRO = [
        'title' => 'TÍTULO não foi preenchido',
        'title.max' => 'TÍTULO deve ter no máximo :max caracteres',
        
        'image.max' => 'IMAGEM deve ter no máximo :max caracteres',
    ];

    public const REGRAS_DA_MODEL = [
        'title' => "required|max:40",
        'image' => "max:100",
    ];
}
