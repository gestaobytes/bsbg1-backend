<?php

namespace App\Models\Validations;

class SettingValidation
{

    public const MENSAGENS_DE_ERRO = [
        'websitename.required' => 'WEB SITE NAME não foi preenchido',
        'websitename.max' => 'WEB SITE NAME deve ter no máximo :max caracteres',
        
        'toplogo.required' => 'TOP LOGO não foi preenchido',
        'toplogo.max' => 'TOP LOGO deve ter no máximo :max caracteres',
        
        'logofooter.required' => 'LOGO FOOTER não foi preenchido',
        'logofooter.max' => 'LOGO FOOTER deve ter no máximo :max caracteres',
        
        'favicon.required' => 'FAVICON não foi preenchido',
        'favicon.max' => 'FAVICON deve ter no máximo :max caracteres',
        
        'metatitle.required' => 'METATITLE não foi preenchido',
        'metatitle.max' => 'METATITLE deve ter no máximo :max caracteres',
        
        'metadescription.required' => 'META DESCRIPTION não foi preenchido',
        'metadescription.max' => 'META DESCRIPTION deve ter no máximo :max caracteres',
        
        'metakeywords.required' => 'META KEYWORDS não foi preenchido',
        'metakeywords.max' => 'META KEYWORDS deve ter no máximo :max caracteres',
        
        'termsofuse.required' => 'TERM SOFUSE não foi preenchido',
        'termsofuse.max' => 'TERM SOFUSE deve ter no máximo :max caracteres',
        
        'codgoogle.required' => 'COD GOOGLE não foi preenchido',
        'codgoogle' => 'COD GOOGLE deve ter no máximo :max caracteres',
        
        'urlapp.required' => 'URL APP não foi preenchido',
        'urlapp.max' => 'URL APP deve ter no máximo :max caracteres',
        
        'passwordapp.required' => 'PASSWORD APP não foi preenchido',
        'passwordapp.max' => 'PASSWORD APP deve ter no máximo :max caracteres',
    ];

    public const REGRAS_DA_MODEL = [
        'websitename' => 'required|max:120',
        'toplogo' => 'required|max:30',
        'logofooter' => 'required|max:30',
        'favicon' => 'required|max:30',
        'metatitle' => 'required|max:120',
        'metadescription' => 'required|max:255',
        'metakeywords' => 'required|max:255',
        'termsofuse' => 'required|max:120',
        'codgoogle' => 'required',
        'urlapp' => 'required|max:30',
        'passwordapp' => 'required|max:120',
        
    ];

}