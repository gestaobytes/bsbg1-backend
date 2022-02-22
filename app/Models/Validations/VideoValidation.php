<?php

namespace App\Models\Validations;

class VideoValidation
{

    public const MENSAGENS_DE_ERRO = [
        'post_id.required' => 'POST não foi preenchido',
        'post_id.numeric' => 'POST deve ser numérico',
        
        'title.required' => 'TITLE não foi preenchido',
        'title.max' => 'TITLE deve ter no máximo :max caracteres',
        
        'url.required' => 'URL não foi preenchido',
        'url.max' => 'URL deve ter no máximo :max caracteres',
        
        'description.required' => 'DESCRIPTION não foi preenchido',
        'description.max' => 'DESCRIPTION deve ter no máximo :max caracteres',
    ];

    public const REGRAS_DA_MODEL = [
        'post_id' => 'required|numeric',
        'title' => 'required|max:140',
        'url' => 'required|max:244',
        'description' => 'required|max:244',
        
    ];
}
