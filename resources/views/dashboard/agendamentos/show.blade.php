<!-- resources/views/agendamentos/show.blade.php -->
@extends('layouts.dashboard')

@section('title', 'Detalhes do Agendamento')

@section('content')
<!-- <h1>Detalhes do Agendamento</h1> -->
<div class="app-content">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-md-12">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header">
                        <div class="card-title"> <h4>Detalhes do Agendamento </h4></div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Agendamento para: {{ $agendamento->tarefa }}</h5><br>
                        <p class="card-text"><strong>Data e Hora:</strong> {{ $agendamento->data_hora->format('d/m/Y H:i') }}</p>
                        <p class="card-text"><strong>Local:</strong> {{ $agendamento->local }}</p>
                        <p class="card-text"><strong>Trabalhador:</strong> {{ $agendamento->trabalhador?->nome_trabalhador ?? 'Não atribuído' }}</p>
                        <p class="card-text"><strong>Observação:</strong> {{ $agendamento->observacao }}</p>
                    </div>
                </div>
            </div>
        </div>
   
    <a href="{{ route('agendamentos.index') }}" class="btn btn-primary mt-3">Voltar</a>
<!-- Fechamento do div da class app-content para ajustar o espaço de todos os elementos -->
</div> 
    @endsection