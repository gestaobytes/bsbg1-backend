<?php

namespace App\Models\Validations;

class PositionBannerValidation
{

    public const MENSAGENS_DE_ERRO = [
        'name.required' => 'NOME não foi preenchido',
        'name.max' => 'NOME deve ter no máximo :max caracteres',
        
        'description.required' => 'DESCRIPTION não foi preenchido',
        'description.max' => 'DESCRIPTION deve ter no máximo :max caracteres'
    ];

    public const REGRAS_DA_MODEL = [
        'name' => "required|max:120",
        'description' => "required|max:255",
    ];
}
