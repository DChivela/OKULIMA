<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_equipamento',
        'nome_equipamento',
        'data_aquisicao',
        'valor_aquisicao',
        'vida_util',
        'custo_hora',
    ];
}
