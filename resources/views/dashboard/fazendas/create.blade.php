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
                            <div class="card-title">Registo de Fazendas</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('fazendas.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Nº Interno</label>
                                    <input type="text" class="form-control" name="numero_fazenda" placeholder="Ex. 66534" required>
                                </div>
                                <div class="form-group">
                                    <label>Nome da Fazenda</label>
                                    <input type="text" class="form-control" name="nome_fazenda" placeholder="Ex. Fazenda Quiala" required>
                                </div>
                                <div class="form-group">
                                    <label>Área (Hectares)</label>
                                    <input type="text" class="form-control" name="area_fazenda" placeholder="Ex. 5000" required>
                                </div>
                                <div class="form-group">
                                    <label>Data de Aquisição</label>
                                    <input type="date" class="form-control" name="data_aquisicao" required>
                                </div>
                                <div class="form-group">
                                    <label>Data de Início de Exploração</label>
                                    <input type="date" class="form-control" name="data_exploracao" required>
                                </div>
                                <div class="form-group">
                                    <label>País</label>
                                    <select class="form-control" name="pais_id" id="pais" required>
                                        <option value="" selected>Selecione o País</option>
                                        @foreach($paises as $pais)
                                            <option value="{{ $pais->id }}">{{ $pais->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Província</label>
                                    <select class="form-control" name="provincia_id" id="provincia" required>
                                        <option value="" selected>Selecione a Província</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Município</label>
                                    <select class="form-control" name="municipio_id" id="municipio" required>
                                        <option value="" selected>Selecione o Município</option>
                                    </select>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        $('#pais').on('change', function() {
                                            var paisId = this.value;
                                            $('#provincia').html('<option value="">Selecione a Província</option>');
                                            $('#municipio').html('<option value="">Selecione o Município</option>');
                                            if (paisId) {
                                                $.ajax({
                                                    url: '/provincias/' + paisId,
                                                    type: 'GET',
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        $.each(data, function(key, value) {
                                                            $('#provincia').append('<option value="' + value.id + '">' + value.nome + '</option>');
                                                        });
                                                    }
                                                });
                                            }
                                        });

                                        $('#provincia').on('change', function() {
                                            var provinciaId = this.value;
                                            $('#municipio').html('<option value="">Selecione o Município</option>');
                                            if (provinciaId) {
                                                $.ajax({
                                                    url: '/municipios/' + provinciaId,
                                                    type: 'GET',
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        $.each(data, function(key, value) {
                                                            $('#municipio').append('<option value="' + value.id + '">' + value.nome + '</option>');
                                                        });
                                                    }
                                                });
                                            }
                                        });
                                    });
                                </script>
                                <div class="form-group">
                                    <label>Rios</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rios" id="rio_sim" value="1" required>
                                        <label class="form-check-label" for="rio_sim">Sim</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rios" id="rio_nao" value="0" required>
                                        <label class="form-check-label" for="rio_nao">Não</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Extensão dos Rios (km)</label>
                                    <input type="text" class="form-control" name="extensao_rios" placeholder="Ex. 5000">
                                </div>
                                <div class="form-group">
                                    <label>Furos de Água</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="furos" id="furo_sim" value="1" required>
                                        <label class="form-check-label" for="furo_sim">Sim</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="furos" id="furo_nao" value="0" required>
                                        <label class="form-check-label" for="furo_nao">Não</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Quantidade de Furos de Água</label>
                                    <input type="text" class="form-control" name="qtd_furos" placeholder="Ex. 5000">
                                </div>
                                <div class="form-group">
                                    <label>Nº Matriz Predial</label>
                                    <input type="text" class="form-control" name="numero_matriz" placeholder="Ex. 66534" required>
                                </div>
                                <div class="form-group">
                                    <label>Valor Predial</label>
                                    <input type="text" class="form-control" name="valor_predial" placeholder="Ex. 66534" required>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary form-control">Registar Fazenda</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
