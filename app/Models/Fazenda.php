<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fazenda extends Model
{
    use HasFactory;

    protected $table = 'fazendas';

    protected $fillable = [
        'numero_fazenda',
        'nome_fazenda',
        'area_fazenda',
        'data_aquisicao',
        'data_exploracao',
        'pais_id',
        'provincia_id',
        'municipio_id',
        'rios',
        'extensao_rios',
        'furos',
        'qtd_furos',
        'numero_matriz',
        'valor_predial',
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
}
