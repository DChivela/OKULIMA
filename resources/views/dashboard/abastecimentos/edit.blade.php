<!-- resources/views/abastecimentos/edit.blade.php -->

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
                            <div class="card-title">Editar Abastecimento</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('abastecimentos.update', $abastecimento->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Equipamento a Abastecer</label>
                                            <select class="form-control select2bs4" name="equipamento_id" required>
                                                @foreach($equipamentos as $equipamento)
                                                    <option value="{{ $equipamento->id }}" {{ $equipamento->id == $abastecimento->equipamento_id ? 'selected' : '' }}>{{ $equipamento->nome_equipamento }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Produto</label>
                                            <select class="form-control select2bs4" name="produto" required>
                                                <option value="Gasóleo" {{ $abastecimento->produto == 'Gasóleo' ? 'selected' : '' }}>Gasóleo</option>
                                                <option value="Gasolina" {{ $abastecimento->produto == 'Gasolina' ? 'selected' : '' }}>Gasolina</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Quantidade (Litros)</label>
                                            <input type="number" class="form-control" name="quantidade" value="{{ $abastecimento->quantidade }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Preço Unitário</label>
                                            <input type="number" class="form-control" name="preco_unitario" value="{{ $abastecimento->preco_unitario }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Data de Abastecimento</label>
                                            <input type="datetime-local" class="form-control" name="data_abastecimento" value="{{ $abastecimento->data_abastecimento }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary form-control">Atualizar Abastecimento</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
