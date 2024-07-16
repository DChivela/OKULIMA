@extends('layouts.dashboard')
@section('title', 'Okulima - Sistema de Gestão Agrícola Inteligente')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('UpdateTrabalhador', $trabalhador->id) }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="numero_profissao" class="form-label">Número de profissão</label>
                <input type="text" class="form-control" id="numero_profissao" name="numero_profissao" value="{{ $trabalhador->numero_profissao }}" required>
            </div>
            <div class="mb-3">
                <label for="nome_profissao" class="form-label">Nome da profissão</label>
                <input type="text" class="form-control" id="nome_profissao" name="nome_profissao" value="{{ $trabalhador->nome_profissao }}" required>
            </div>
            <div class="mb-3">
                <label for="custo_trabalho" class="form-label">Custo por Hora</label>
                <input type="number" class="form-control" id="custo_trabalho" name="custo_trabalho" value="{{ $trabalhador->custo_trabalho }}" step="0.01" required>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary form-control">Atualizar Trabalhador</button>
            </div>
        </form>
    </div>
</div>
@endsection
