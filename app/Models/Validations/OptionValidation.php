<?php

namespace App\Models\Validations;

class OptionValidation
{

    public const MENSAGENS_DE_ERRO = [
        'feature_id.required' => 'FEATURE não foi preenchido',
        'feature_id.numeric' => 'FEATURE deve ser numérico',
       
        'description.required' => 'DESCRIPTION não foi preenchido',
        'description.max' => 'DESCRIPTION deve ter no máximo :max caracteres',
       
    ];

    public const REGRAS_DA_MODEL = [
        'feature_id' => "required|numeric",
        'description' => "required|max:255",
    ];

}