@extends('layouts.dashboard')
@section('title', 'Okulima - Sistema de Gestão Agrícola Inteligente')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                @include('msg.system')
                @include('msg.user')
                <div class="col-md-12">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Registo de Trabalhadores</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('StoreTrabalhador') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="numero_profissao" class="form-label">Número de profissão</label>
                                    <input type="text" class="form-control" id="numero_profissao" name="numero_profissao" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nome_profissao" class="form-label">Nome da profissão</label>
                                    <input type="text" class="form-control" id="nome_profissao" name="nome_profissao" required>
                                </div>
                                <div class="mb-3">
                                    <label for="custo_trabalho" class="form-label">Custo por Hora</label>
                                    <input type="number" class="form-control" id="custo_trabalho" name="custo_trabalho" step="0.01" required>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary form-control">Registar Trabalhador</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
