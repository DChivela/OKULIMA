@extends('layouts.dashboard')
@section('title', 'Okulima - Sistema de Gestão Agrícola Inteligente')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            @include('msg.system')
            @include('msg.user')

            {{-- Contagem total dos registros --}}
            <div class="row pt-5">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-primary shadow-sm"> <i class="bi bi-tools"></i> </span>
                        <div class="info-box-content"> <span class="info-box-text">Equipamentos</span> <span class="info-box-number"> {{ $equipamentos->count() }} Registado(s) </span> </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-danger shadow-sm"> <i class="bi bi-building"></i> </span>
                        <div class="info-box-content"> <span class="info-box-text">Fazendas </span> <span class="info-box-number"> {{ $fazendas->count() }} Registado(s)</span> </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-success shadow-sm"> <i class="bi bi-tree"></i> </span>
                        <div class="info-box-content"> <span class="info-box-text">Campos de Cultivo </span> <span class="info-box-number"> {{ $CamposCultivos->count() }} Registado(s)</span> </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-warning shadow-sm"> <i class="bi bi-people-fill"></i> </span>
                        <div class="info-box-content"> <span class="info-box-text">Trabalhadores </span> <span class="info-box-number"> {{ $trabalhadores->count() }} Registado(s)</span> </div>
                    </div>
                </div>
            </div>

            {{-- Gráficos --}}
            <div class="row">
                <div class="col-md-8">
                    <p class="text-center"> <strong>Gráfico Mensal de Abastecimento e Colheitas por mês</strong> </p>
                    <div id="sales-chart"></div>
                </div>
                <div class="col-md-4">
                    <p class="text-center"> <strong>Gráfico de atividades de registo</strong> </p>
                    <div id="pie-chart"></div>
                </div>
                <div class="col-md-12">
                    <div class="row g-4 mb-4"></div>
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    {{-- Tabela de registros recentes da tabela fazendas --}}
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>Número</th>
                                                <th>Nome</th>
                                                <th>Área</th>
                                                <th>Data Aquisição</th>
                                                <th>Data Exploração</th>
                                                <th>Localização</th>
                                                <th>Rios</th>
                                                <th>Extensão Rios</th>
                                                <th>Furos</th>
                                                <th>Qtd. Furos</th>
                                                <th>Número Matriz</th>
                                                <th>Valor Predial</th>
                                                <th>Data Criação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($fazendas as $fazenda)
                                                <tr>
                                                    <td>{{ $fazenda->numero_fazenda }}</td>
                                                    <td>{{ $fazenda->nome_fazenda }}</td>
                                                    <td>{{ $fazenda->area_fazenda }}</td>
                                                    <td>{{ $fazenda->data_aquisicao }}</td>
                                                    <td>{{ $fazenda->data_exploracao }}</td>
                                                    <td>{{ $fazenda->pais->nome }}, {{ $fazenda->provincia->nome }}, {{ $fazenda->municipio->nome }}</td>
                                                    <td>{{ $fazenda->rios }}</td>
                                                    <td>{{ $fazenda->extensao_rios }}</td>
                                                    <td>{{ $fazenda->furos }}</td>
                                                    <td>{{ $fazenda->qtd_furos }}</td>
                                                    <td>{{ $fazenda->numero_matriz }}</td>
                                                    <td>{{ $fazenda->valor_predial }}</td>
                                                    <td>{{ $fazenda->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <div class="card-footer clearfix">
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary float-start">Registrar Nova Fazenda</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-end">Ver Todas as Fazendas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Gráficos --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
    <script>
        // Gráfico Mensal de Abastecimento e Colheitas por mês
        const sales_chart_options = {
            series: [
                {
                    name: "Abastecimento",
                    data: @json($abastecimento_mensal),
                },
                {
                    name: "Atividade Colheita",
                    data: @json($atividade_colheita_mensal),
                },
            ],
            chart: {
                height: 350,
                type: "area",
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth",
            },
            xaxis: {
                type: "datetime",
                categories: @json($meses),
            },
            tooltip: {
                x: {
                    format: "MM/yyyy",
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector("#sales-chart"),
            sales_chart_options
        );
        sales_chart.render();

        // Gráfico de atividades de registo
        const pie_chart_options = {
            series: [
                @json($abastecimento_total),
                @json($atividade_colheita_total),
                @json($atividade_maquina_total),
                @json($atividade_trabalhador_total),
            ],
            chart: {
                width: 380,
                type: "pie",
            },
            labels: ["Abastecimento", "Atividade Colheita", "Atividade Maquina", "Atividade Trabalhador"],
        };

        const pie_chart = new ApexCharts(
            document.querySelector("#pie-chart"),
            pie_chart_options
        );
        pie_chart.render();
    </script>
@endsection
