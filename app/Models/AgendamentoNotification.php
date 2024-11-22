<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class AgendamentoNotification extends Model
{
    use HasFactory;

    protected $table = 'agendamento_notifications';

    protected $fillable = [
        'agendamento_id',
        'user_id',
        'title',
        'message',
        'read',
        'data_hora'
    ];

    protected $casts = [
        'read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Corrigir relação: uma notificação pertence a um agendamento
    public function agendamento()
    {
        return $this->belongsTo(Agendamentos::class, 'agendamento_id');
    }

    // Relação com o usuário
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scope para notificações não lidas
    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }

    // Scope para notificações do usuário atual
    public function scopeCurrentUser($query)
    {
        return $query->where('user_id', Auth::id());
    }

    // Scope para ordenar por data de criação
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Método para marcar como lida
    public function markAsRead()
    {
        return $this->update(['read' => true]);
    }

    // Método de classe para marcar todas as notificações como lidas
    public static function markAllAsRead()
    {
        return self::where('user_id', Auth::id())
            ->where('read', false)
            ->update(['read' => true]);
    }

    // Acessor para mensagem formatada
    public function getFormattedMessageAttribute()
    {
        return nl2br(e($this->message));
    }

    // Método para criar notificação única
    public static function createUniqueNotification($agendamento, $title, $message)
    {
        return self::firstOrCreate(
            [
                'agendamento_id' => $agendamento->id,
                'user_id' => Auth::id(),
                'title' => $title
            ],
            [
                'message' => $message,
                'read' => false
            ]
        );

    }

    // Método para limpar notificações antigas
    public static function clearOldNotifications($days = 30)
    {
        return self::where('created_at', '<', now()->subDays($days))->delete();
    }
    
}