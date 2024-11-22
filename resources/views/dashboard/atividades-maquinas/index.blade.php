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
                                        <label>Tipo de actividade</label>
                                        <input type="text" class="form-control" name="tipo_atividade" id="tipo_atividade" required>
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
                                <button type="submit" class="btn btn-primary form-control">Registar Atividade</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="input-group mb-4 mt-2">
                    <input type="text" id="searchQuery" class="form-control" placeholder="Buscar por maquinas...">

                </div>
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header">
                        <div class="card-title">Lista de Atividades de Máquinas</div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <!-- Cada <input> tem o atributo data-column que indica a coluna a ser filtrada. -->
                                <tr>
                                    <!-- O CSS inserido manualmente em cada th, serve para afixar a tabela e scroll separado -->
                                    <th style="position: sticky; left: 0; background: white;">
                                        Equipamento
                                        <!-- Foram adicionas filtros individuais para cada coluna da tabela -->
                                        <input type="text" class="search-input" data-column="equipamento" placeholder="Tractor">
                                    </th>
                                    <th style="position: sticky; left: 0; background: white;">
                                        Fazenda
                                        <input type="text" class="search-input" data-column="fazenda" placeholder="Fazenda Lubango">
                                    </th>
                                    <th style="position: sticky; left: 0; background: white;">
                                        Campo
                                        <input type="text" class="search-input" data-column="campo" placeholder="Campo Dombe">
                                    </th>
                                    <th class="hide-on-small" style="position: sticky; left: 0; background: white;">
                                        Actividade
                                        <input type="text" class="search-input" data-column="actividade" placeholder="Irrigação">
                                    </th>
                                    <th>
                                        Data
                                        <input type="text" class="search-input" data-column="data" id="data" placeholder="AAAA-MM-DD" maxlength="10">
                                    </th>
                                    <th class="hide-on-small">
                                        Hora Inicial
                                        <input type="text" class="search-input" data-column="hora-inicial" id="searchHoraInicial" placeholder="00:00:00">
                                    </th>
                                    <th class="hide-on-small">
                                        Hora Final
                                        <input type="text" class="search-input" data-column="hora-final" id="searchHoraFinal" placeholder="00:00:00">
                                    </th>
                                    <th class="hide-on-small">
                                        Duração
                                        <input type="text" class="search-input" data-column="duracao" placeholder="60min">
                                    </th>
                                    <th>
                                        Custo Unitário
                                        <input type="text" class="search-input" data-column="custo-unitario" id="custo-unitario" placeholder="10.000,00">
                                    </th>
                                    <th class="hide-on-small">
                                        Valor do Trabalho
                                        <input type="text" class="search-input" data-column="valor-trabalho" id="valor-trabalho" placeholder="0.000,00">
                                    </th>
                                    <th>Ações
                                    <input placeholder="Editar/Apagar" readonly>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($atividades as $atividade)
                                <tr class="table-row">
                                    <!-- O CSS inserido manualmente em cada td, serve para afixar a tabela e scroll separado -->
                                    <td class="equipamento" style="position: sticky; left: 0; background: white;">
                                        @php
                                        $equipamento = $equipamentos->firstWhere('id', $atividade->equipamentos_id);
                                        @endphp
                                        {{ $equipamento ? $equipamento->nome_equipamento : 'N/A' }}
                                    </td>
                                    <td class="fazenda" style="position: sticky; left: 0; background: white;">
                                        @php
                                        $fazenda = $fazendas->firstWhere('id', $atividade->fazendas_id);
                                        @endphp
                                        {{ $fazenda ? $fazenda->nome_fazenda : 'N/A' }}
                                    </td>
                                    <td class="campo" style="position: sticky; left: 0; background: white;">
                                        @php
                                        $campo = $campos->firstWhere('id', $atividade->campos_cultivo_id);
                                        @endphp
                                        {{ $campo ? $campo->nome_campo : 'N/A' }}
                                    </td>
                                    <td class="actividade" style="position: sticky; left: 0; background: white;">

                                        {{ $atividade->tipo_atividade}}
                                    </td>
                                    <!-- O nome da class em cada TD das colunas acima como as que se encontram abaixo, servem ligar o campo de pesquisa às colunas abaixo
                                     ou seja, servem para dizer ao sistema que o campo cujo o usuário está a preencher se refere a coluna x ou y que se encontra abaixo.
                                      -->
                                    <td class="data">{{ $atividade->data_atividade }}</td>
                                    <td class="hora-inicial">{{ $atividade->hora_inicial }}</td>
                                    <td class="hora-final">{{ $atividade->hora_final }}</td>
                                    <td class="duracao">{{ $atividade->duracao }}</td>
                                    <td class="custo-unitario">{{ number_format($atividade->custo_unitario, 2, ',', '.') }} AOA</td>
                                    <td class="valor-trabalho">{{ number_format($atividade->valor_trabalho, 2, ',', '.') }} AOA</td>
                                    <td>

                                        <a href="{{ route('atividades-maquinas.edit', $atividade->id) }}" class="btn btn-info"><i class="bi bi-pencil"></i></a>
                                        <form action="{{ route('atividades-maquinas.destroy', $atividade->id) }}" method="post" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir esta atividade?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
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
    document.addEventListener('DOMContentLoaded', function() {
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

        calcularValorBtn.addEventListener('click', function() {
            calcularDuracao();
            calcularValorTrabalho();
        });

        $('#equipamentos_id').change(function() {
            var selectedOption = $(this).val();

            $.ajax({
                url: '{{ route("obter_custo_hora") }}',
                type: 'GET',
                data: {
                    equipamento_id: selectedOption
                },
                success: function(response) {
                    $('#custo_unitario').val(response);
                },
                error: function() {
                    alert('Erro ao obter o custo do equipamento.');
                }
            });
        });

        /*Funçao para Pesquisa no frontend sem necessidade de request na base de dados
         */

        // Seleciona todos os campos de input para pesquisa
        const searchInputs = document.querySelectorAll(".search-input");

        // Seleciona todas as linhas da tabela
        const rows = document.querySelectorAll(".table-row");

        // Adiciona evento 'input' a cada campo de pesquisa
        searchInputs.forEach((input) => {
            input.addEventListener("input", () => {
                const query = input.value.trim().toLowerCase(); // Valor digitado, sem espaços extras
                const columnClass = input.dataset.column; // Classe CSS correspondente à coluna

                rows.forEach(row => {
                    const cell = row.querySelector(`.${columnClass}`); // Célula correspondente
                    const cellText = cell ? cell.textContent.trim().toLowerCase() : "";

                    // Mostra ou oculta a linha dependendo do valor digitado
                    if (cellText.includes(query)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });

        // Função para formatar o horário conforme o usuário digita
        function formatTimeInput(value) {
            // Remove qualquer caractere que não seja dígito
            let cleanValue = value.replace(/\D/g, '');

            // Limita a 6 dígitos (HHMMSS)
            if (cleanValue.length > 6) {
                cleanValue = cleanValue.slice(0, 6);
            }

            // Formata o horário
            if (cleanValue.length > 4) {
                return `${cleanValue.slice(0, 2)}:${cleanValue.slice(2, 4)}:${cleanValue.slice(4)}`;
            } else if (cleanValue.length > 2) {
                return `${cleanValue.slice(0, 2)}:${cleanValue.slice(2)}`;
            } else {
                return cleanValue;
            }
        }

        // Seleciona os campos de pesquisa de hora
        const hora_InicialInput = document.getElementById('searchHoraInicial');
        const hora_FinalInput = document.getElementById('searchHoraFinal');

        // Adiciona evento 'input' para formatação automática
        [hora_InicialInput, hora_FinalInput].forEach(input => {
            input.addEventListener('input', function(e) {
                const formattedValue = formatTimeInput(e.target.value);
                e.target.value = formattedValue;
            });
        });

        const data = document.getElementById("data");

        data.addEventListener("input", function(e) {
            let value = e.target.value.replace(/[^0-9]/g, ""); // Remove caracteres não numéricos
            if (value.length > 4 && value.length <= 6) {
                value = value.slice(0, 4) + "-" + value.slice(4);
            } else if (value.length > 6) {
                value = value.slice(0, 4) + "-" + value.slice(4, 6) + "-" + value.slice(6, 8);
            }
            e.target.value = value;
        });


    });
</script>