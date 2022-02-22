<?php

namespace App\Models\Validations;

class SocialColumnValidation
{

    public const MENSAGENS_DE_ERRO = [
        'event_id.required' => 'EVENT não foi preenchido',
        'event_id.numeric' => 'EVENT deve ser numérico',
        
        'title.required' => 'TITLE não foi preenchido',
        'title.max' => 'TITLE deve ter no máximo :max caracteres',
        
        'note.required' => 'NOTE não foi preenchido',
        'note.text' => 'NOTE deve ter no máximo :max caracteres',
        
        'tags.required' => 'TAGS não foi preenchido',
        'tags.max' => 'TAGS deve ter no máximo :max caracteres',
        
        'slug.required' => 'SLUG não foi preenchido',
        'slug.max' => 'SLUG deve ter no máximo :max caracteres',
    ];

    public const REGRAS_DA_MODEL = [
        'event_id' => 'required|numeric',
        'title' => 'required|max:100',
        'note' => 'required|text',
        'tags' => 'required|max:255',
        'slug' => 'required|max:130',
        
    ];
}
