@extends('layouts.dashboard')
@section('title', 'Okulima - Registrar Atividade de Trabalhador')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                @include('msg.system')
                @include('msg.user')
                <div class="col-md-12">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Registrar Atividade de Trabalhador</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('atividades-trabalhador.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Trabalhador</label>
                                            <select class="form-control select2bs4" name="trabalhador_id" id="trabalhador_id" required>
                                                <option value="">Selecione o Trabalhador</option>
                                                @foreach($trabalhadores as $trabalhador)
                                                    <option value="{{ $trabalhador->id }}">
                                                        {{ $trabalhador->numero_profissao }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Fazenda</label>
                                            <select class="form-control select2bs4" name="fazenda_id" required>
                                                <option value="">Selecione a Fazenda</option>
                                                @foreach($fazendas as $fazenda)
                                                    <option value="{{ $fazenda->id }}">
                                                        {{ $fazenda->nome_fazenda }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Campo</label>
                                            <select class="form-control select2bs4" name="campo_cultivo_id" required>
                                                <option value="">Selecione o Campo</option>
                                                @foreach($campos as $campo)
                                                    <option value="{{ $campo->id }}">
                                                        {{ $campo->nome_campo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Data</label>
                                            <input type="date" class="form-control" name="data" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Hora Inicial</label>
                                            <input type="time" class="form-control" name="hora_inicial" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Hora Final</label>
                                            <input type="time" class="form-control" name="hora_final" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Duração (min)</label>
                                            <input type="number" class="form-control" name="duracao" id="duracao" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Custo Unitário (AOA)</label>
                                            <input type="number" step="0.01" class="form-control" name="custo_unitario" id="custo_unitario" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Valor do Trabalho (AOA)</label>
                                            <input type="number" step="0.01" class="form-control" name="valor_trabalho" id="valor_trabalho" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success">Registrar Atividade</button>
                                        <a href="{{ route('atividades-trabalhador.index') }}" class="btn btn-secondary">Cancelar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#trabalhador_id').change(function () {
            var selectedOption = $(this).val();

            $.ajax({
                url: '{{ route("obterCustoTrabalhador") }}',
                type: 'GET',
                data: { trabalhador_id: selectedOption },
                success: function (response) {
                    $('#custo_unitario').val(response);
                },
                error: function () {
                    alert('Erro ao obter o custo unitário do produto.');
                }
            });
        });

        function calcularDuracao() {
            var horaInicial = document.querySelector('input[name="hora_inicial"]').value;
            var horaFinal = document.querySelector('input[name="hora_final"]').value;

            if (horaInicial && horaFinal) {
                var inicio = new Date('1970-01-01T' + horaInicial + 'Z');
                var fim = new Date('1970-01-01T' + horaFinal + 'Z');
                var diff = (fim - inicio) / 60000; // diferença em minutos
                if (diff < 0) {
                    diff += 24 * 60; // ajustar para o caso de passar da meia-noite
                }
                document.getElementById('duracao').value = diff;

                calcularValorTrabalho();
            }
        }

        function calcularValorTrabalho() {
            var duracao = document.getElementById('duracao').value;
            var custoUnitario = document.getElementById('custo_unitario').value;

            if (duracao && custoUnitario) {
                var valorTrabalho = (duracao / 60) * custoUnitario; // duração está em minutos
                document.getElementById('valor_trabalho').value = valorTrabalho.toFixed(2);
            }
        }

        document.querySelector('input[name="hora_inicial"]').addEventListener('change', calcularDuracao);
        document.querySelector('input[name="hora_final"]').addEventListener('change', calcularDuracao);
        document.getElementById('custo_unitario').addEventListener('input', calcularValorTrabalho);
    </script>
@endsection
