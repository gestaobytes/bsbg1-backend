<?php

namespace App\Models\Validations;

class LayoutValidation
{

    public const MENSAGENS_DE_ERRO = [
        'linkedin.required' => 'LINKEDIN não foi preenchido',
        'linkedin.max' => 'LINKEDIN deve ter no máximo :max caracteres',
       
    ];

    public const REGRAS_DA_MODEL = [
        'name' => "required|max:20",
        'description' => "required|max:200",
        'standardfontcolor' => "required|max:30",
        'colortop' => "required|max:30",
        'colorsourcetop' => "required|max:30",
        'colorfooter' => "required|max:30",
        'colorsourcefooter' => "required|max:30",
        'status' => "required|max:15",
        'image' => "required|max:50",
    ];
}