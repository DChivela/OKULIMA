@extends('layouts.dashboard')
@section('title', 'Okulima - Editar Atividade de Trabalhador')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                @include('msg.system')
                @include('msg.user')
                <div class="col-md-12">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Editar Atividade de Trabalhador</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('atividades-trabalhador.update', $atividade->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Trabalhador</label>
                                            <select class="form-control select2bs4" name="trabalhador_id" required>
                                                <option value="">Selecione o Trabalhador</option>
                                                @foreach($trabalhadores as $trabalhador)
                                                    <option value="{{ $trabalhador->id }}" {{ $atividade->trabalhador_id == $trabalhador->id ? 'selected' : '' }}>
                                                        {{ $trabalhador->numero_profissao }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Fazenda</label>
                                            <select class="form-control select2bs4" name="fazenda_id" required>
                                                <option value="">Selecione a Fazenda</option>
                                                @foreach($fazendas as $fazenda)
                                                    <option value="{{ $fazenda->id }}" {{ $atividade->fazenda_id == $fazenda->id ? 'selected' : '' }}>
                                                        {{ $fazenda->nome_fazenda }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Campo de Cultivo</label>
                                            <select class="form-control select2bs4" name="campo_id" required>
                                                <option value="">Selecione o Campo</option>
                                                @foreach($campos as $campo)
                                                    <option value="{{ $campo->id }}" {{ $atividade->campo_id == $campo->id ? 'selected' : '' }}>
                                                        {{ $campo->nome_campo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Data</label>
                                            <input type="date" class="form-control" name="data" value="{{ $atividade->data }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Hora Inicial</label>
                                            <input type="time" class="form-control" name="hora_inicial" value="{{ $atividade->hora_inicial }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Hora Final</label>
                                            <input type="time" class="form-control" name="hora_final" value="{{ $atividade->hora_final }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Duração (em minutos)</label>
                                            <input type="text" class="form-control" name="duracao" id="duracao" value="{{ $atividade->duracao }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Custo Unitário</label>
                                            <input type="text" class="form-control" name="custo_unitario" id="custo_unitario" value="{{ $atividade->custo_unitario }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Valor do Trabalho</label>
                                            <input type="text" class="form-control" name="valor_trabalho" id="valor_trabalho" value="{{ $atividade->valor_trabalho }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Atualizar Atividade</button>
                                    <a href="{{ route('atividades-trabalhador.index') }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const horaInicialInput = document.querySelector('input[name="hora_inicial"]');
            const horaFinalInput = document.querySelector('input[name="hora_final"]');
            const duracaoInput = document.getElementById('duracao');
            const custoUnitarioInput = document.getElementById('custo_unitario');
            const valorTrabalhoInput = document.getElementById('valor_trabalho');

            function calcularDuracao() {
                const horaInicial = new Date(`1970-01-01T${horaInicialInput.value}:00`);
                const horaFinal = new Date(`1970-01-01T${horaFinalInput.value}:00`);
                let duracao = (horaFinal - horaInicial) / (1000 * 60);

                if (duracao < 0) {
                    duracao += 24 * 60;
                }

                duracaoInput.value = duracao;
            }

            function calcularValorTrabalho() {
                const duracao = parseFloat(duracaoInput.value);
                const custoUnitario = parseFloat(custoUnitarioInput.value);

                if (!isNaN(duracao) && !isNaN(custoUnitario)) {
                    const valorTrabalho = (duracao / 60) * custoUnitario;
                    valorTrabalhoInput.value = valorTrabalho.toFixed(2);
                }
            }

            horaInicialInput.addEventListener('change', calcularDuracao);
            horaFinalInput.addEventListener('change', calcularDuracao);

            custoUnitarioInput.addEventListener('input', calcularValorTrabalho);
            duracaoInput.addEventListener('input', calcularValorTrabalho);

            document.querySelector('select[name="trabalhador_id"]').addEventListener('change', function() {
                var trabalhadorId = this.value;
                if (trabalhadorId) {
                    fetch(`/atividades-trabalhador/custo-trabalhador?trabalhador_id=${trabalhadorId}`)
                        .then(response => response.json())
                        .then(data => {
                            custoUnitarioInput.value = data;
                            calcularValorTrabalho();
                        })
                        .catch(error => console.error('Erro:', error));
                }
            });
        });
    </script>
@endsection
