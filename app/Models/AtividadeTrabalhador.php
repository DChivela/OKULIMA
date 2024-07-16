<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtividadeTrabalhador extends Model
{
    use HasFactory;

    protected $table = 'atividades_trabalhador';

    protected $fillable = [
        'trabalhador_id',
        'fazenda_id',
        'campo_cultivo_id',
        'data',
        'hora_inicial',
        'hora_final',
        'duracao',
        'custo_unitario',
        'valor_trabalho'
    ];

    public function trabalhador()
    {
        return $this->belongsTo(Trabalhador::class);
    }

    public function fazenda()
    {
        return $this->belongsTo(Fazenda::class);
    }

    public function campoCultivo()
    {
        return $this->belongsTo(CampoCultivo::class);
    }
}
