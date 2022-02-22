<?php

namespace App\Models\Validations;

class PrintedVersionValidation
{

    public const MENSAGENS_DE_ERRO = [
        'number.required' => 'NUMBER não foi preenchido',
        'number.numeric' => 'NUMBER deve ser numérico',
        
        'date.required' => 'DATE não foi preenchido',
        'date.date' => 'DATE deve ser no padrão Y-m-d',
        
        'pdf.required' => 'PDF não foi preenchido',
        'pdf.max' => 'PDF deve ter no máximo :max caracteres',
    ];

    public const REGRAS_DA_MODEL = [
        'number' => "required|numeric",
        'date' => "required|date",
        'pdf' => "required|max:50",
        
    ];

}

        