<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory;

    protected $table = 'clientes';
    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'email',
        'cep',
        'logradouro',
        'numero',
        'cidade',
        'bairro',
        'complemento',
        'user_id'
    ];
}
