<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabalhador extends Model
{
    use HasFactory;

    protected $table = 'trabalhadores';

    protected $fillable = [
        'numero_profissao',
        'nome_profissao',
        'custo_trabalho',
    ];
}
