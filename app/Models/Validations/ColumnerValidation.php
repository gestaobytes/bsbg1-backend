<?php

namespace App\Models\Validations;

class ColumnerValidation
{

    public const MENSAGENS_DE_ERRO = [
        'user_id.required' => 'USER não foi preenchido',
        'user_id.numeric' => 'USER deve ser numérico',

        'blog_id.required' => 'SUB CATEGORY não foi preenchido',
        'blog_id.numeric' => 'SUB CATEGORY deve ser numérico',

        'description.required' => 'DESCRIPTION não foi preenchido',
        'description.max' => 'DESCRIPTION deve ter no máximo :max caracteres',

        'facebook.required' => 'FACEBOOK não foi preenchido',
        'facebook.max' => 'FACEBOOK deve ter no máximo :max caracteres',

        'twitter.required' => 'TWITTER não foi preenchido',
        'twitter.max' => 'TWITTER deve ter no máximo :max caracteres',

        'google.required' => 'GOOGLE não foi preenchido',
        'google.max' => 'GOOGLE deve ter no máximo :max caracteres',

        'linkedin.required' => 'LINKEDIN não foi preenchido',
        'linkedin.max' => 'LINKEDIN deve ter no máximo :max caracteres',

    ];

    public const REGRAS_DA_MODEL = [
        'user_id' => "required|numeric",
        'blog_id' => "required|numeric",
        'description' => "required|max:255",
        'facebook' => "required|max:255",
        'twitter' => "required|max:255",
        'google' => "required|max:255",
        'linkedin' => "required|max:255",
    ];

}
