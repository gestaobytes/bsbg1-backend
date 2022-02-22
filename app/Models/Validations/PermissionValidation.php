<?php

namespace App\Models\Validations;

class PermissionValidation {

    public const MENSAGENS_DE_ERRO = [
        'name.required' => 'NOME não foi preenchido',
        'name.max' => 'NOME deve ter no máximo :max caracteres',
        'label.required' => 'LABEL não foi preenchido',
        'label.max' => 'LABEL deve ter no máximo :max caracteres',
    ];
 
    public const REGRAS_DA_MODEL = [
        'name' => 'required|max:50',
        'label' => 'required|max:500',
    ];

}

