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
                            <div class="card-title">Registo de Campo de Cultivo</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('campos-cultivo.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Nº Interno Campo</label>
                                    <input type="text" class="form-control" name="numero_campo" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Ex. 66534" required>
                                </div>
                                <div class="form-group">
                                    <label>Nome do Campo</label>
                                    <input type="text" class="form-control" name="nome_campo" placeholder="Ex. Edmilson Quiala" required>
                                </div>
                                <div class="form-group">
                                    <label>Área (Hectares)</label>
                                    <input type="text" class="form-control" name="area_campo" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Ex. 100" required>
                                </div>
                                <div class="form-group">
                                    <label>Fazenda Associada</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="fazenda_associada" required>
                                        @foreach($fazendas as $fazenda)
                                            <option value="{{ $fazenda->id }}">{{ $fazenda->nome_fazenda }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Data de Início de Exploração</label>
                                    <input type="date" class="form-control" name="data_exploracao" required>
                                </div>
                                <div class="form-group">
                                    <label>Sistema de Irrigação</label>
                                    <input type="text" class="form-control" name="sistema_irrigacao" placeholder="Ex. Irrigação Manual" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Registrar Campo</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
