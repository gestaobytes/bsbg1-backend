<?php

namespace App\Models\Validations;

class FeaturePostingValidation
{

    public const MENSAGENS_DE_ERRO = [
        'post_id.required' => 'POST não foi preenchido',
        'post_id.numeric' => 'POST deve ser numérico',
        
        'feature_id.required' => 'FEATURE não foi preenchido',
        'feature_id.numeric' => 'FEATURE deve ser numérico',
    ];

    public const REGRAS_DA_MODEL = [
        'post_id' => "required|numeric",
        'feature_id' => "required|numeric",

        'post_id',
        'feature_id',
    ];

}