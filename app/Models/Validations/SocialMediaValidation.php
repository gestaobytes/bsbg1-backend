<?php

namespace App\Models\Validations;

class SocialMediaValidation
{

    public const MENSAGENS_DE_ERRO = [
        'name.required' => 'NAME não foi preenchido',
        'name.max' => 'NAME deve ter no máximo :max caracteres',
        
        'url.required' => 'URL não foi preenchido',
        'url.max' => 'URL deve ter no máximo :max caracteres',
        
        'app_id.required' => 'APP ID não foi preenchido',
        'app_id.max' => 'APP ID deve ter no máximo :max caracteres',
        
        'app_password.required' => 'APP PASSWORD não foi preenchido',
        'app_password.max' => 'APP PASSWORD deve ter no máximo :max caracteres',
    ];

    public const REGRAS_DA_MODEL = [
        'name' => 'required|max:30',
        'url' => 'required|max:255',
        'app_id' => 'required|max:255',
        'app_password' => 'required|max:255',
        
    ];
}
