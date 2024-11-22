<?php

// app/Models/AtividadeMaquina.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtividadeMaquina extends Model
{
    use HasFactory;

    protected $table = 'atividades_maquinas';

    protected $fillable = [
        'equipamentos_id',
        'fazendas_id',
        'campos_cultivo_id',
        'tipo_atividade',
        'data_atividade',
        'hora_inicial',
        'hora_final',
        'duracao',
        'custo_unitario',
        'valor_trabalho',
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }

    public function fazenda()
    {
        return $this->belongsTo(Fazenda::class);
    }

    public function campo()
    {
        return $this->belongsTo(CampoCultivo::class);
    }
    
}
