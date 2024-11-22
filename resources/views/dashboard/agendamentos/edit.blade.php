@extends('layouts.dashboard')

@section('title', 'Editar Agendamento')

@section('content')

<div class="card card-primary card-outline mb-4">
    <div class="card-header">
        <div class="card-title">
            <h4>Editar Agendamento</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('agendamentos.update', $agendamento) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="tarefa" class="form-label">Tarefa</label>
                <input type="text" class="form-control" id="tarefa" name="tarefa" value="{{ old('tarefa', $agendamento->tarefa) }}" required placeholder="Digite a tarefa aqui...">
            </div>

            <div class="mb-3">
                <label for="data_hora" class="form-label">Data e Hora</label>
                <input type="datetime-local" class="form-control" id="data_hora" name="data_hora"
                    value="{{ $agendamento->data_hora->format('Y-m-d\TH:i') }}" required>
            </div>

            <div class="mb-3">
                <label for="local" class="form-label">Local</label>
                <input type="text" class="form-control" id="local" name="local" value="{{ $agendamento->local }}">
            </div>

            <div class="form-group">
                <label>Trabalhador</label>
                <select class="form-control select2bs4" name="trabalhador_id" required>
                    <option value="">Selecione o Trabalhador</option>
                    @foreach($trabalhadores as $trabalhador)
                    <option value="{{ $trabalhador->id }}" {{ $agendamento->trabalhador_id == $trabalhador->id ? 'selected' : '' }}>
                        {{ $trabalhador->nome_trabalhador}}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Fazenda</label>
                <select class="form-control select2bs4" name="trabalhador_id" required>
                    <option value="">Selecione a Fazenda</option>
                    @foreach($fazendas as $fazenda)
                    <option value="{{ $fazenda->id }}" {{ $agendamento->fazendas_id == $fazenda->id ? 'selected' : '' }}>
                        {{ $fazenda->nome_fazenda}}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Campo de Cultivo</label>
                <select class="form-control select2bs4" name="trabalhador_id" required>
                    <option value="">Selecione o Trabalhador</option>
                    @foreach($trabalhadores as $trabalhador)
                    <option value="{{ $trabalhador->id }}" {{ $agendamento->trabalhador_id == $trabalhador->id ? 'selected' : '' }}>
                        {{ $trabalhador->nome_trabalhador}}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-4">
                        <div class="form-group">
                            <label>Campo de Cultivo</label>
                            <select class="form-control select2bs4" name="campos_cultivo_id" required>
                                <option value="">Selecione o Campo</option>
                                @foreach($campos as $campo)
                                <option value="{{ $campo->id }}" {{ $agendamento->campos_cultivo_id == $campo->id ? 'selected' : '' }}>
                                    {{ $campo->nome_campo }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

            <div class="mb-3">
                <label for="observacao" class="form-label">Observação</label>
                <textarea class="form-control" id="observacao" name="observacao">{{ $agendamento->observacao }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>
@endsection