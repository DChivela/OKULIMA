<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamentos extends Model
{
    use HasFactory;

    protected $fillable = [
        'tarefa', // Altere aqui para 'tarefa' em vez de 'tarefa_id'
        'data_hora',
        'local',
        'trabalhador_id', //Coluna específica que indica a relação com a tabela trabalhadores
        'observacao',
        'fazendas_id',
        'campos_cultivo_id',
    ];

    protected $casts = [
        'data_hora' => 'datetime',
    ];

    //Função que relaciona a tabela agendamentos com trabalhadores
    public function trabalhador()
    {
        return $this->belongsTo(Trabalhador::class);
    }

    public function fazenda()
    {
        return $this->belongsTo(Fazenda::class, 'fazendas_id');
    }
    
    public function campoCultivo()
    {
        return $this->belongsTo(CampoCultivo::class, 'campos_cultivo_id');
    }

}
