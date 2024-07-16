<?php

// app/Models/Abastecimento.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abastecimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipamento_id',
        'produto',
        'quantidade',
        'preco_unitario',
        'data_abastecimento',
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
