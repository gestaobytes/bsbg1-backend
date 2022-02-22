<?php

namespace App\Models\Validations;

class ReactionValidation
{

    public const MENSAGENS_DE_ERRO = [
        'slug.required' => 'SLUG não foi preenchido',
        'slug.max' => 'SLUG deve ter no máximo :max caracteres',

        'emoction.required' => 'EMOCTION não foi preenchido',

        'status.required' => 'STATUS não foi preenchido',

    ];

    public const REGRAS_DA_MODEL = [
        'slug' => "required|max:20",
        'emoction' => "required",
        'status' => "required",

    ];

}
