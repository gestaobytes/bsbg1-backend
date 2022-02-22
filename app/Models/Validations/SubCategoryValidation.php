<?php

namespace App\Models\Validations;

class SubCategoryValidation
{

    public const MENSAGENS_DE_ERRO = [
        'category_id.required' => 'CATEGORY não foi preenchido',
        'category_id.numeric' => 'CATEGORY deve ser numérico',

        'order.numeric' => 'ORDEM deve ser do tipo numérico',

        'title.required' => 'TITLE não foi preenchido',
        'title.max' => 'TITLE deve ter no máximo :max caracteres',

        'description.required' => 'DESCRIPTION não foi preenchido',
        'description.max' => 'DESCRIPTION deve ter no máximo :max caracteres',
    ];

    public const REGRAS_DA_MODEL = [
        'category_id' => 'required|numeric',
        'title' => 'required|max:50',
        'order' => '',
        'description' => 'required|max:250',

    ];
}
