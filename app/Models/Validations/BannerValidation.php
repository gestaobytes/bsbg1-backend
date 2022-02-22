<?php

namespace App\Models\Validations;

class BannerValidation
{

    public const MENSAGENS_DE_ERRO = [
        'positionbanner_id.required' => 'POSIÇÃO não foi selecionada',
        'positionbanner_id.numeric' => 'POSIÇÃO deve ser numérico',
        
        'url.required' => 'URL não foi preenchido',
        'url.max' => 'URL deve ter no máximo :max caracteres',
        
        'order.required' => 'ORDEM não foi preenchido',
        'order.numeric' => 'ORDEM deve ser numérico',
        
        'start' => 'DT INÍCIO não foi preenchida',
        'start.date' => 'DT INÍCIO deve ser no padrão Y-m-d',
        
        'end' => 'DT FINAL não foi preenchida',
        'end.date' => 'DT FINAL deve ser no padrão Y-m-d',
        
        'name.required' => 'NOME DA MÍDIA não foi preenchida',
        'name.max' => 'NOME DA MÍDIA deve ter no máximo :max caracteres',
        
        'image.required' => 'IMAGEM não foi preenchida',
    ];

    public const REGRAS_DA_MODEL = [
        'positionbanner_id' => "required|numeric",
        'url' => "required|max:80",
        'order' => "required|numeric",
        'start' => "required|date",
        'end' => "required|date",
        'name' => "required|max:120",
        'image' => "required",
    ];


}