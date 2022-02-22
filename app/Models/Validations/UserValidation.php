<?php

namespace App\Models\Validations;

class UserValidation {

    public const MENSAGENS_DE_ERRO = [

        'registration.max' => 'CADASTRO deve ter no máximo :max caracteres',

        'name.required' => 'NOME não foi preenchido',
        'name.max' => 'NOME deve ter no máximo :max caracteres',

        'genre.max' => 'GENERO deve ter no máximo :max caracteres',

        // 'birthday.date' => 'ANIVERSARIO deve ser no padrão Y-m-d',

        'cpf.max' => 'CPF deve ter no máximo :max caracteres',

        'rg.max' => 'RG deve ter no máximo :max caracteres',

        'image.max' => 'FOTOGRAFIA deve ter no máximo :max caracteres',

        'status.required' => 'STATUS não foi preenchido',
        'status.max' => 'STATUS deve ter no máximo :max caracteres',

        'phone.required' => 'TELEFONE não foi preenchido',
        'phone.max' => 'TELEFONE deve ter no máximo :max caracteres',

        'cellphone.required' => 'CELULAR não foi preenchido',
        'cellphone.max' => 'CELULAR deve ter no máximo :max caracteres',

        'cellphone2.max' => 'CELULAR 2 deve ter no máximo :max caracteres',

        'email.required' => 'E-MAIL não foi preenchido',
        'email.max' => 'E-MAIL deve ter no máximo :max caracteres',

        'password.max' => 'SENHA deve ter no máximo :max caracteres',

        'type.required' => 'TIPO não foi preenchido',
        'type.max' => 'TIPO deve ter no máximo :max caracteres',

        'required' => ':attribute não foi preenchido',
        'numeric'     => ':attribute deve ser numérico',
        'date_format' => ':attribute deve ser no padrão Y-m-d',
        'max'         => 'O :attribute deve ter no máximo :max caracteres',
    ];

    public const REGRAS_DA_MODEL = [
        'registration' => 'required|max:20',
        'name' => 'required|max:80',
        'genre' => 'max:1',
        // 'birthday' => 'date',
        'cpf' => 'max:14',
        'rg' => 'max:18',
        'image' => '',
        'status' => 'required|max:10',
        'phone' => 'max:14',
        'cellphone' => 'required|max:14',
        'cellphone2' => 'max:14',
        // 'email' => 'required|max:255|unique:users,email,((ID{?})),id',
        'email' => 'required|max:255',
        'password' => 'max:100',
        'type' => 'required|max:20',
    ];

}

