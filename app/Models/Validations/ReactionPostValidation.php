<?php

namespace App\Models\Validations;

class ReactionPostValidation
{

    public const MENSAGENS_DE_ERRO = [
        'post_id.required' => 'POST não foi preenchido',
        'post_id.numeric' => 'POST deve ser numérico',
        
        'reaction_id.required' => 'REACTION não foi preenchido',
        'reaction_id.numeric' => 'REACTION deve ser numérico',
        
        'ip.required' => 'IP não foi preenchido',
        'ip.max' => 'IP deve ter no máximo :max caracteres',
    ];

    public const REGRAS_DA_MODEL = [
        'post_id' => "required|numeric",
        'reaction_id' => "required|numeric",
        'ip' => "max:16",
        'votes' => "numeric",
        
    ];
}
