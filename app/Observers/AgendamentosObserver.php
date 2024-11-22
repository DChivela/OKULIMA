<?php
namespace App\Observers;

use App\Models\Agendamentos;
use App\Models\AgendamentoNotification;
use Illuminate\Support\Facades\Auth;

class AgendamentosObserver
{
   /*public function created(Agendamentos $agendamento): void
    {
        AgendamentoNotification::create([
            'agendamento_id' => $agendamento->id,
            'user_id' => Auth::id(),
            'title' => 'Novo Agendamento Criado',
            'message' => "Um novo agendamento foi criado para " . $agendamento->data_hora->format('d/m/Y H:i'),
            'read' => false,
        ]);
    }*/

    /*public function updated(Agendamentos $agendamento): void
    {
        if ($agendamento->wasChanged('data_hora')) {
            AgendamentoNotification::create([
                'agendamento_id' => $agendamento->id,
                'user_id' => Auth::id(),
                'title' => 'Agendamento Atualizado',
                'message' => "O agendamento foi atualizado para " . $agendamento->data_hora->format('d/m/Y H:i'),
                'read' => false,
            ]);
        }
    }*/

   /* public function deleting(Agendamentos $agendamento): void
    {
        // Criar a notificação antes de o agendamento ser realmente excluído
        AgendamentoNotification::create([
            'agendamento_id' => $agendamento->id,
            'user_id' => Auth::id(),
            'title' => 'Agendamento Cancelado',
            'message' => "Um agendamento foi cancelado",
            'read' => false,
        ]);
    }*/
}
