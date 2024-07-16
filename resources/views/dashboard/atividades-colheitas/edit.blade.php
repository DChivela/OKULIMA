@extends('layouts.dashboard')
@section('title', 'Okulima - Editar Atividade de Colheita')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                @include('msg.system')
                @include('msg.user')
                <div class="col-md-12">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Editar Atividade de Colheita</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('atividades-colheitas.update', $atividade->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Produto</label>
                                            <select class="form-control select2bs4" name="produto_id" id="produto_id" required>
                                                <option value="">Selecione o Produto</option>
                                                @foreach($produtos as $produto)
                                                    <option value="{{ $produto->id }}" {{ $atividade->produto_id == $produto->id ? 'selected' : '' }}>
                                                        {{ $produto->nome_produto }}
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
                                                    <option value="{{ $fazenda->id }}" {{ $atividade->fazenda_id == $fazenda->id ? 'selected' : '' }}>
                                                        {{ $fazenda->nome_fazenda }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Campo de Cultivo</label>
                                            <select class="form-control select2bs4" name="campo_cultivo_id" required>
                                                <option value="">Selecione o Campo</option>
                                                @foreach($campos as $campo)
                                                    <option value="{{ $campo->id }}" {{ $atividade->campo_cultivo_id == $campo->id ? 'selected' : '' }}>
                                                        {{ $campo->nome_campo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Quantidade (Kg)</label>
                                            <input type="number" class="form-control" name="quantidade" id="quantidade" value="{{ $atividade->quantidade }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Data</label>
                                            <input type="date" class="form-control" name="data" value="{{ $atividade->data }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Hora Inicial</label>
                                            <input type="time" class="form-control" name="hora_inicial" id="hora_inicial" value="{{ $atividade->hora_inicial }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Hora Final</label>
                                            <input type="time" class="form-control" name="hora_final" id="hora_final" value="{{ $atividade->hora_final }}" required>
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
                                            <input type="number" class="form-control" name="duracao" id="duracao" value="{{ $atividade->duracao }}" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Custo Unitário</label>
                                            <input type="number" class="form-control" name="custo_unitario" id="custo_unitario" value="{{ $atividade->custo_unitario }}" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Valor da Colheita</label>
                                            <input type="number" class="form-control" name="valor_colheita" id="valor_colheita" value="{{ $atividade->valor_colheita }}" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary form-control">Atualizar Atividade</button>
                                </div>
                            </form>
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
        const valorColheitaInput = document.getElementById('valor_colheita');
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

        function calcularValorColheita() {
            const duracao = parseFloat(duracaoInput.value);
            const custoUnitario = parseFloat(custoUnitarioInput.value);

            if (!isNaN(duracao) && !isNaN(custoUnitario)) {
                const valorColheita = (duracao / 60) * custoUnitario;
                valorColheitaInput.value = valorColheita.toFixed(2);
            }
        }

        horaInicialInput.addEventListener('change', calcularDuracao);
        horaFinalInput.addEventListener('change', calcularDuracao);

        calcularValorBtn.addEventListener('click', function () {
            calcularDuracao();
            calcularValorColheita();
        });

        $('#produto_id').change(function () {
            var selectedOption = $(this).val();

            $.ajax({
                url: '{{ route("obterPrecoProduto") }}',
                type: 'GET',
                data: { produto_id: selectedOption },
                success: function (response) {
                    $('#custo_unitario').val(response);
                },
                error: function () {
                    alert('Erro ao obter o custo unitário do produto.');
                }
            });
        });
    });
</script>
