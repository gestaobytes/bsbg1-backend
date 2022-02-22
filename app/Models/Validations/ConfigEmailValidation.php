<?php

namespace App\Models\Validations;

class ConfigEmailValidation
{

    public const MENSAGENS_DE_ERRO = [
        'address.required' => 'ADDRESS não foi preenchido',
        'address.max' => 'ADDRESS deve ter no máximo :max caracteres',
        
        'driver.required' => 'DRIVER não foi preenchido',
        'driver.max' => 'DRIVER deve ter no máximo :max caracteres',
        
        'host.required' => 'HOST não foi preenchido',
        'host.max' => 'HOST deve ter no máximo :max caracteres',
        
        'port.required' => 'PORT não foi preenchido',
        'port.max' => 'PORT deve ter no máximo :max caracteres',
        
        'username.required' => 'USER NAME não foi preenchido',
        'username.max' => 'USER NAME deve ter no máximo :max caracteres',
        
        'password.required' => 'PASSWORD não foi preenchido',
        'password.max' => 'PASSWORD deve ter no máximo :max caracteres',
        
        'encryption.required' => 'ENCRYPTION não foi preenchido',
        'encryption.max' => 'ENCRYPTION deve ter no máximo :max caracteres',

    ];

    public const REGRAS_DA_MODEL = [
        'address' => "required|max:150",
        'driver' => "required|max:20",
        'host' => "required|max:50",
        'port' => "required|max:5",
        'username' => "required|max:150",
        'password' => "required|max:150",
        'encryption' => "required|max:5",
    ];

}
