<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampoCultivo extends Model
{
    use HasFactory;

    protected $table = 'campos_cultivo';

    protected $fillable = [
        'numero_campo',
        'nome_campo',
        'area_campo',
        'fazenda_id',
        'data_exploracao',
        'sistema_irrigacao'
    ];

    public function fazenda()
    {
        return $this->belongsTo(Fazenda::class);
    }
}
