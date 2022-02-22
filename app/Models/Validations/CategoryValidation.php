<?php

namespace App\Models\Validations;

class CategoryValidation
{

    public const MENSAGENS_DE_ERRO = [
        'type.required' => 'TYPE não foi preenchido',
        'type.max' => 'TYPE deve ter no máximo :max caracteres',

        'title.required' => 'TITLE não foi preenchido',
        'title.max' => 'TITLE deve ter no máximo :max caracteres',

        'order.numeric' => 'ORDEM deve ser do tipo numérico',

        'title.required' => 'DESCRIÇÃO não foi preenchido',
        'title.max' => 'DESCRIÇÃO deve ter no máximo :max caracteres',
        'title.min' => 'DESCRIÇÃO deve ter no mínimo :max caracteres',

        'topcolor.required' => 'COR DO TOPO não foi preenchido',
        'topcolor.max' => 'COR DO TOPO deve ter no máximo :max caracteres',

        'colorsourcetop.required' => 'COR DA FONTE não foi preenchido',
        'colorsourcetop.max' => 'COR DA FONTE deve ter no máximo :max caracteres',

        'linktop.required' => 'LINK TOP não foi preenchido',
        'linkfooter.required' => 'LINK FOOTER não foi preenchido',

    ];

    public const REGRAS_DA_MODEL = [
        'type' => "required|max:30",
        'title' => "required|max:50",
        'order' => "",
        'description' => "required|max:250",
        'topcolor' => "required|max:30",
        'colorsourcetop' => "required|max:30",
        'linktop' => "required",
        'linkfooter' => "required",
    ];


}
