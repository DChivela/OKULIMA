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
                            <div class="card-title">Registo de Atividades de Máquinas</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('atividades-maquinas.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Equipamento</label>
                                            <select class="form-control select2bs4" name="equipamentos_id" id="equipamentos_id" required>
                                                <option value="">Selecione o Equipamento</option>
                                                @foreach($equipamentos as $equipamento)
                                                    <option value="{{ $equipamento->id }}">{{ $equipamento->nome_equipamento }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Fazenda</label>
                                            <select class="form-control select2bs4" name="fazendas_id" required>
                                                <option value="">Selecione a Fazenda</option>
                                                @foreach($fazendas as $fazenda)
                                                    <option value="{{ $fazenda->id }}">{{ $fazenda->nome_fazenda }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Campo de Cultivo</label>
                                            <select class="form-control select2bs4" name="campos_cultivo_id" required>
                                                <option value="">Selecione o Campo</option>
                                                @foreach($campos as $campo)
                                                    <option value="{{ $campo->id }}">{{ $campo->nome_campo }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Data</label>
                                            <input type="date" class="form-control" name="data_atividade" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Hora Inicial</label>
                                            <input type="time" class="form-control" name="hora_inicial" id="hora_inicial" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Hora Final</label>
                                            <input type="time" class="form-control" name="hora_final" id="hora_final" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-danger form-control" id="calcular_valor_btn">Calcular Valor</button>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Duração (Em minutos)</label>
                                            <input type="number" class="form-control" name="duracao" id="duracao" readonly required>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Custo Unitário</label>
                                            <input type="number" class="form-control" name="custo_unitario" id="custo_unitario" readonly required>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Valor do Trabalho</label>
                                            <input type="number" class="form-control" name="valor_trabalho" id="valor_trabalho" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary form-control">Registrar Atividade</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Lista de Atividades de Máquinas</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Equipamento</th>
                                        <th>Fazenda</th>
                                        <th>Campo</th>
                                        <th>Data</th>
                                        <th>Hora Inicial</th>
                                        <th>Hora Final</th>
                                        <th>Duração</th>
                                        <th>Custo Unitário</th>
                                        <th>Valor do Trabalho</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($atividades as $atividade)
                                        <tr>
                                            <td>
                                                @php
                                                    $equipamento = $equipamentos->firstWhere('id', $atividade->equipamentos_id);
                                                @endphp
                                                {{ $equipamento ? $equipamento->nome_equipamento : 'N/A' }}
                                            </td>
                                            <td>
                                                @php
                                                    $fazenda = $fazendas->firstWhere('id', $atividade->fazendas_id);
                                                @endphp
                                                {{ $fazenda ? $fazenda->nome_fazenda : 'N/A' }}
                                            </td>
                                            <td>
                                                @php
                                                    $campo = $campos->firstWhere('id', $atividade->campos_cultivo_id);
                                                @endphp
                                                {{ $campo ? $campo->nome_campo : 'N/A' }}
                                            </td>
                                            <td>{{ $atividade->data_atividade }}</td>
                                            <td>{{ $atividade->hora_inicial }}</td>
                                            <td>{{ $atividade->hora_final }}</td>
                                            <td>{{ $atividade->duracao }}</td>
                                            <td>{{ number_format($atividade->custo_unitario, 2, ',', '.') }} AOA</td>
                                            <td>{{ number_format($atividade->valor_trabalho, 2, ',', '.') }} AOA</td>
                                            <td>
                                                <a href="{{ route('atividades-maquinas.edit', $atividade->id) }}" class="btn btn-primary">Editar</a>
                                                <form action="{{ route('atividades-maquinas.destroy', $atividade->id) }}" method="post" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir esta atividade?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const horaInicialInput = document.getElementById('hora_inicial');
        const horaFinalInput = document.getElementById('hora_final');
        const duracaoInput = document.getElementById('duracao');
        const custoUnitarioInput = document.getElementById('custo_unitario');
        const valorTrabalhoInput = document.getElementById('valor_trabalho');
        const calcularValorBtn = document.getElementById('calcular_valor_btn');

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

        calcularValorBtn.addEventListener('click', function () {
            calcularDuracao();
            calcularValorTrabalho();
        });

        $('#equipamentos_id').change(function () {
            var selectedOption = $(this).val();

            $.ajax({
                url: '{{ route("obter_custo_hora") }}',
                type: 'GET',
                data: { equipamento_id: selectedOption },
                success: function (response) {
                    $('#custo_unitario').val(response);
                },
                error: function () {
                    alert('Erro ao obter o custo do equipamento.');
                }
            });
        });
    });
</script>
