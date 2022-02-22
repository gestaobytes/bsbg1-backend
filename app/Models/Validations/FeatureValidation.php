<?php

namespace App\Models\Validations;

class FeatureValidation
{

    public const MENSAGENS_DE_ERRO = [
        'name.required' => 'NAME não foi preenchido',
        'name.max' => 'NAME deve ter no máximo :max caracteres',
        
        'question.required' => 'QUESTION não foi preenchido',
        'question.max' => 'QUESTION deve ter no máximo :max caracteres',
        
        'date_register.required' => 'DATE REGISTER não foi preenchido',
        'date_register.date' => 'DATE REGISTER deve ser no padrão Y-m-d',

        'date_start.required' => 'DATE START não foi preenchido',
        'date_start.date' => 'DATE START deve ser no padrão Y-m-d',
        
        'date_end.required' => 'DATE END não foi preenchido',
        'date_end.date' => 'DATE END deve ser no padrão Y-m-d',
        
        'situation.required' => 'SITUATION não foi preenchido',
        'situation.max' => 'SITUATION deve ter no máximo :max caracteres',
    ];

    public const REGRAS_DA_MODEL = [
        'name' => "required|max:30",
        'question' => "required|max:255",
        'date_register' => "required|date",
        'date_start' => "required|date",
        'date_end' => "required|date",
        'situation' => "required|max:1",
    ];

}
