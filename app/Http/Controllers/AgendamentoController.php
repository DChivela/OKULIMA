<?php
namespace App\Http\Controllers;

use App\Models\Agendamentos;
use Illuminate\Http\Request;
use App\Models\AgendamentoNotification; // Certifique-se de incluir a importação do modelo de notificações
use App\Models\Trabalhador;
use App\Models\Fazenda;
use App\Models\CampoCultivo;

class AgendamentoController extends Controller
{
    public function index()
    {
        // Recupera todos os agendamentos
        //dd($agendamentos); Função para verificar se os dados estão a ser realmente carregados.
        $agendamentos = Agendamentos::with('trabalhador', 'fazenda', 'campoCultivo' )->get();
        return view('dashboard.agendamentos.index', compact('agendamentos'));
        
    }

    public function create()
    {
        $trabalhadores = Trabalhador::orderBy('nome_trabalhador', 'asc')->get();
        $fazendas = Fazenda::orderBy('nome_fazenda', 'asc')->get();
        $campos = CampoCultivo::orderBy('nome_campo', 'asc')->get();
        return view('dashboard.agendamentos.create', compact('trabalhadores','fazendas', 'campos'));
    }

    public function store(Request $request)
    {
        // Validação do formulário
        $request->validate([
            'tarefa' => 'required|string|max:255', // Alterar para 'tarefa'
            'data_hora' => 'required|date',
            'local' => 'nullable|max:255',
            'trabalhador_id' => 'required',
            'observacao' => 'nullable',
            'fazendas_id' => 'required',
            'campos_cultivo_id' => 'required',
        ]);

        // Criar o agendamento
        $agendamento = Agendamentos::create($request->all());
        // $agendamento['id_trabalhador'] = $request->trabalhador_associado;

        // Criar a notificação
        AgendamentoNotification::create([
            'agendamento_id' => $agendamento->id, // Use o ID do agendamento criado
            'user_id' => auth()->id(),
            'title' => $agendamento->tarefa,
            'data_hora' => $agendamento->data_hora,
            'message' => $agendamento->observacao,
            'read' => false,
        ]);

        return redirect()->route('agendamentos.index')
            ->with('success', 'Agendamento criado com sucesso.');
    }

    public function show(Agendamentos $agendamento)
    {
        return view('dashboard.agendamentos.show', compact('agendamento'));
    }

    public function edit($id)
    {
        $agendamento = Agendamentos::findOrFail($id);
        $trabalhadores = Trabalhador::orderBy('nome_trabalhador', 'asc')->get();
        $fazendas = Fazenda::orderBy('nome_fazenda', 'asc')->get();
        $campos = CampoCultivo::orderBy('nome_campo', 'asc')->get();
        return view('dashboard.agendamentos.edit', compact('agendamento', 'trabalhadores', 'fazendas', 'campos'));
    }
    public function update(Request $request, $id)
    {
        // Validação do formulário
        $request->validate([
            'tarefa' => 'required|string|max:255', // Alterar para 'tarefa'
            'data_hora' => 'required|date',
            'local' => 'nullable|max:255',
            'trabalhador_id' => 'required',
            'observacao' => 'nullable',
            'fazendas_id' => 'required',
            'campos_cultivo_id' => 'required',
        ]);

        // Atualizar o agendamento
        $agendamento = Agendamentos::findOrFail($id);
        $agendamento->update($request->all());

        return redirect()->route('agendamentos.index')
            ->with('success', 'Agendamento atualizado com sucesso.');
    }

    public function destroy(Agendamentos $agendamento)
    {
        // Excluir o agendamento
        $agendamento->delete();

        return redirect()->route('agendamentos.index')
            ->with('success', 'Agendamento excluído com sucesso.');
    }

    // public function getCampo($fazenda_id)
    // {
    //     $campos_cultivo = CampoCultivo::where('fazenda_id', $fazenda_id)->get();
    //     return response()->json($campos_cultivo);
    // }

}
