<?php

namespace App\Models\Validations;

class CompanyValidation
{

    public const MENSAGENS_DE_ERRO = [
        'fantasy_name.required' => 'FANTASY NAME não foi preenchido',
        'fantasy_name.max' => 'FANTASY NAME deve ter no máximo :max caracteres',
       
        'social_reason.required' => 'SOCIAL REASON não foi preenchido',
        'social_reason.max' => 'SOCIAL REASON deve ter no máximo :max caracteres',
       
        'country_insc.required' => 'COUNTRY INSC não foi preenchido',
        'country_insc.max' => 'COUNTRY INSC deve ter no máximo :max caracteres',
       
        'state_insc.required' => 'STATE INSC não foi preenchido',
        'state_insc.max' => 'STATE INSC deve ter no máximo :max caracteres',
       
        'cnpj.required' => 'CNPJ não foi preenchido',
        'cnpj.max' => 'CNPJ deve ter no máximo :max caracteres',
       
        'address.required' => 'ADDRESS não foi preenchido',
        'address.max' => 'ADDRESS deve ter no máximo :max caracteres',
       
        'city.required' => 'CITY não foi preenchido',
        'city.max' => 'CITY deve ter no máximo :max caracteres',
       
        'uf.required' => 'UF não foi preenchido',
        'uf.max' => 'UF deve ter no máximo :max caracteres',
       
        'cep.required' => 'CEP não foi preenchido',
        'cep.max' => 'CEP deve ter no máximo :max caracteres',
       
        'phone.required' => 'PHONE não foi preenchido',
        'phone.max' => 'PHONE deve ter no máximo :max caracteres',
       
        'logo.required' => 'LOGO não foi preenchido',
        'logo.max' => 'LOGO deve ter no máximo :max caracteres',

    ];

    public const REGRAS_DA_MODEL = [
        'fantasy_name' => "required|max:200",
        'social_reason' => "required|max:200",
        'country_insc' => "required|max:20",
        'state_insc' => "required|max:20",
        'cnpj' => "required|max:20",
        'address' => "required|max:200",
        'city' => "required|max:120",
        'uf' => "required|max:2",
        'cep' => "required|max:15",
        'phone' => "required|max:14",
        'logo' => "required|max:50",
    ];

}
