<?php

namespace App\Models\Validations;

class WisheValidation
{

    public const MENSAGENS_DE_ERRO = [
        'option_id.required' => 'OPTION não foi preenchido',
        'option_id.numeric' => 'OPTION deve ser numérico',
        
        'ip.required' => 'IP não foi preenchido',
        'ip.max' => 'IP deve ter no máximo :max caracteres',
        
        'qtd.required' => 'QTD não foi preenchido',
        'qtd.numeric' => 'QTD deve ser numérico',
    ];

    public const REGRAS_DA_MODEL = [
        'option_id' => 'required|numeric',
        'ip' => 'required|max:20',
        'qtd' => 'required|integer',
        
    ];
}
