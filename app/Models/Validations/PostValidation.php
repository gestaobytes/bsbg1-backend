<?php

namespace App\Models\Validations;

class PostValidation
{

    public const MENSAGENS_DE_ERRO = [
        'subcategory_id.required' => 'EDITORIA não foi selecionada',
        'subcategory_id.numeric' => 'EDITORIA deve ser numérico',

        'position_id.required' => 'POSIÇÃO não foi selecionada',
        'position_id.numeric' => 'POSIÇÃO deve ser numérico',

        // 'user_id.required' => 'USUÁRIO não foi identificado',
        // 'user_id.numeric' => 'CÓDIGO DO USUÁRIO deve ser numérico',

        'retracts.required' => 'RETRANCA não foi preenchida',
        'retracts.max' => 'RETRANCA deve ter no máximo :max caracteres',

        'title.required' => 'TÍTULO não foi preenchido',
        'title.max' => 'TÍTULO deve ter no máximo :max caracteres',

        // 'slug.required' => 'SLUG não foi preenchido',
        // 'slug.max' => 'SLUG deve ter no máximo :max caracteres',

        'titleadapter.required' => 'TÍTULO ADAPTADO não foi preenchido',
        'titleadapter.max' => 'TÍTULO ADAPTADO deve ter no máximo :max caracteres',

        'subtitle.required' => 'SUBTÍTULO não foi preenchido',
        'subtitle.max' => 'SUBTÍTULO deve ter no máximo :max caracteres',

        'text.required' => 'TEXTO não foi preenchido',

        'image_credit.max' => 'CRÉDITO DA IMAGEM deve ter no máximo :max caracteres',
        'image_subtitle.max' => 'LEGENDA DA IMAGEM deve ter no máximo :max caracteres',

        'tags.required' => 'TAGS não foi preenchido',
        'tags.max' => 'TAGS deve ter no máximo :max caracteres',


        'date_start.required' => 'DATA DE INICIO não foi informada',
        'date_start.date' => 'DATA DE INICIO deve ser no padrão Y-m-d',


        'status.required' => 'STATUS não foi preenchido',
        'will_restrict_users.required' => 'RESTRIÇÕES não foi informado',
    ];

    public const REGRAS_DA_MODEL = [
        'subcategory_id' => "required|numeric",
        'position_id' => "required|numeric",
        // 'user_id' => "required|numeric",
        'retracts' => "required|max:60",
        'title' => "required|max:180",
        'titleadapter' => "required|max:180",
        // 'slug' => "required|max:256",
        'subtitle' => "required|max:256",
        // 'date_start' => "required|date",
        'text' => "required",
        'image_credit' => "max:60",
        'image_subtitle' => "max:256",
        'tags' => "required|max:256",
        'will_restrict_users' => "required",
        'status' => "required",

    ];
}
