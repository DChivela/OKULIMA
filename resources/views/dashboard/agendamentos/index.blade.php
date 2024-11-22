@extends('layouts.dashboard')

@section('title', 'Lista de Agendamentos')

@section('content')



@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card card-primary card-outline mb-4">
    <div class="card-header">
        <div class="card-title">
            <h4>Lista de Agendamentos</h4>
        </div>
    </div>
    <a href="{{ route('agendamentos.create') }}" class="btn btn-primary mb-3 mr-3">Novo Agendamento</a>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tarefa</th>
                    <th>Data e Hora</th>
                    <th>Local</th>
                    <th>Trabalhador</th>
                    <th>Fazenda</th>
                    <th>Campo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($agendamentos as $agendamento)
                <tr>
                    <td>{{ $agendamento->id }}</td>
                    <td>{{ $agendamento->tarefa }}</td> {{-- Alterado para usar o campo tarefa diretamente --}}
                    <td>{{ $agendamento->data_hora->format('d/m/Y H:i') }}</td>
                    <td>{{ $agendamento->local }}</td>
                    <td class="nome-trabalhador">
                        {{ $agendamento->trabalhador?->nome_trabalhador ?? 'Não atribuído' }}
                    </td>
                    <td>{{ $agendamento->fazenda?->nome_fazenda ?? 'Não atribuído' }}</td>
                    <td>{{ $agendamento->campoCultivo?->nome_campo ?? 'Não atribuído' }}</td>



                    <td>
                        <a href="{{ route('agendamentos.show', $agendamento) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('agendamentos.edit', $agendamento) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('agendamentos.destroy', $agendamento) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection