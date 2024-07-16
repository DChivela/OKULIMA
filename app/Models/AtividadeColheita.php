<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtividadeColheita extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id', 'fazenda_id', 'campo_cultivo_id', 'data', 'hora_inicial', 'hora_final', 'duracao', 'custo_unitario', 'valor_colheita'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
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
