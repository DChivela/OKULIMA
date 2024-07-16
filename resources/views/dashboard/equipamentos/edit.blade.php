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
                            <div class="card-title">Editar Equipamento</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('UpdateEquipamento', $equipamento->id) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="numero_equipamento" class="form-label">Número do Equipamento</label>
                                    <input type="number" class="form-control" id="numero_equipamento" name="numero_equipamento" value="{{ $equipamento->numero_equipamento }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nome_equipamento" class="form-label">Nome do Equipamento</label>
                                    <input type="text" class="form-control" id="nome_equipamento" name="nome_equipamento" value="{{ $equipamento->nome_equipamento }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="data_aquisicao" class="form-label">Data de aquisição</label>
                                    <input type="date" class="form-control" id="data_aquisicao" name="data_aquisicao" value="{{ $equipamento->data_aquisicao }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="valor_aquisicao" class="form-label">Valor da Aquisição</label>
                                    <input type="number" class="form-control" id="valor_aquisicao" name="valor_aquisicao" value="{{ $equipamento->valor_aquisicao }}" step="0.01" required>
                                </div>
                                <div class="mb-3">
                                    <label for="vida_util" class="form-label">Vida Util</label>
                                    <input type="number" class="form-control" id="vida_util" name="vida_util" value="{{ $equipamento->vida_util }}" step="0.01" required>
                                </div>
                                <div class="mb-3">
                                    <label for="custo_hora" class="form-label">Custo por Hora</label>
                                    <input type="number" class="form-control" id="custo_hora" name="custo_hora" value="{{ $equipamento->custo_hora }}" step="0.01" required>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary form-control">Atualizar Equipamento</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
