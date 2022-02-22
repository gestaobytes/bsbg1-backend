<?php

namespace App\Models\Validations;

class ArticleValidation
{

    public const MENSAGENS_DE_ERRO = [
        'post_id.required' => 'POST não foi preenchido',
        'post_id.numeric' => 'POST deve ser numérico',

        'title.required' => 'TITULO não foi preenchido',
        'title.max' => 'TITULO deve ter no máximo :max caracteres',
        
        'text.required' => 'SLUG não foi preenchido',
        'text.max' => 'SLUG deve ter no máximo :max caracteres',

    ];

    public const REGRAS_DA_MODEL = [
        'post_id' => "required|numeric",
        'title' => "required|max:100",
        'text' => "required|text",
    ];

}
