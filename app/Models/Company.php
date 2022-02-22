<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model {

    use SoftDeletes;
    protected $table = 'companies';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fantasy_name',
        'social_reason',
        'country_insc',
        'state_insc',
        'cnpj',
        'address',
        'city',
        'uf',
        'cep',
        'phone',
        'logo',
    ];
    
}
