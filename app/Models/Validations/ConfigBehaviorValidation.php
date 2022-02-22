<?php

namespace App\Models\Validations;

class ConfigBehaviorValidation
{

    public const MENSAGENS_DE_ERRO = [
        'urlmethod.required' => 'URL METHOD não foi preenchido',
        'urlmethod.max' => 'URL METHOD deve ter no máximo :max caracteres',

        'votewithoutregistration.required' => 'VOTE WITHOUT REGISTRATION não foi preenchido',
        'votewithoutregistration.max' => 'VOTE WITHOUT REGISTRATION deve ter no máximo :max caracteres',

        'selfapproval.required' => 'SELF APPROVAL não foi preenchido',
        'selfapproval.max' => 'SELF APPROVAL deve ter no máximo :max caracteres',

        'autolistinghome.required' => 'AUTO LISTING HOME não foi preenchido',
        'autolistinghome.max' => 'AUTO LISTING HOME deve ter no máximo :max caracteres',

        'autoloadconfig.required' => 'AUTO LOAD CONFIG não foi preenchido',
        'autoloadconfig.max' => 'AUTO LOAD CONFIG deve ter no máximo :max caracteres',

    ];

    public const REGRAS_DA_MODEL = [
        'urlmethod' => "required|max:120",
        'votewithoutregistration' => "required|max:3",
        'selfapproval' => "required|max:3",
        'autolistinghome' => "required|max:3",
        'autoloadconfig' => "required|max:3",
    ];

}