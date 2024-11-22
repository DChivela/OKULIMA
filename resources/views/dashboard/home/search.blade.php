@extends('layouts.dashboard')
@section('title', 'Okulima - Pesquisa')

@section('content')
<style>
    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        background-color: #f9f9f9;
        margin-bottom: 15px;
    }

    .card-body {
        display: flex;
        flex-direction: column;
    }

    .card-text pre {
        white-space: pre-wrap;
        word-break: break-all;
    }

    h4 {
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .activity-details {
        margin-top: 10px;
        padding: 10px;
        background-color: #f5f5f5;
        border-radius: 5px;
    }
</style>
<div class="app-content">
    <div class="container-fluid">
        @include('msg.system')
        @include('msg.user')

        <div class="row pt-5">
            <div class="col-12">
                <form id="search-form" class="mb-4">
                    <div class="input-group">
                        <input type="text" id="search-query" class="form-control" placeholder="Pesquisar...">
                        <button class="btn btn-primary" type="submit">Pesquisar</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="loading-spinner" style="display: none;">Carregando...</div>
                <div id="search-results"></div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('search-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const query = document.getElementById('search-query').value;
        const resultsContainer = document.getElementById('search-results');
        const loadingSpinner = document.getElementById('loading-spinner');

        loadingSpinner.style.display = 'block';
        resultsContainer.innerHTML = '';

        fetch(`/search-results?query=${query}`)
            .then(response => response.json())
            .then(data => {
                loadingSpinner.style.display = 'none';
                resultsContainer.innerHTML = '';

                if (data.length === 0) {
                    resultsContainer.innerHTML = '<p>Nenhum resultado encontrado.</p>';
                    return;
                }

                let currentTable = '';

                data.forEach(result => {
                    if (result.table !== currentTable) {
                        currentTable = result.table;
                        const tableHeader = document.createElement('h4');
                        tableHeader.classList.add('mt-4', 'mb-3');
                        tableHeader.innerText = `Resultados encontrados em: ${currentTable}`;
                        resultsContainer.appendChild(tableHeader);
                    }

                    const card = document.createElement('div');
                    card.classList.add('card', 'mb-3', 'shadow-sm');

                    let cardContent = '';

                    // Mantendo os casos existentes e adicionando os novos
                    switch (result.table) {
                        case 'fazendas':
                            cardContent = `
                                <h5 class="card-title">Fazenda: ${result.data.nome_fazenda}</h5>
                                <p><strong>Número da Fazenda:</strong> ${result.data.numero_fazenda}</p>
                            `;
                            break;

                        case 'campos_cultivo':
                            cardContent = `
                                <h5 class="card-title">Nome do campo: ${result.data.nome_campo}</h5>
                                <p><strong>Número do campo:</strong> ${result.data.numero_campo}</p>
                                <p><strong>Fazenda Associada:</strong> ${result.data.nome_fazenda}</p>
                            `;
                            break;

                        case 'trabalhadores':
                            cardContent = `
                                <h5 class="card-title">Nome do Trabalhador: ${result.data.nome_trabalhador}</h5>
                                <p><strong>Profissão:</strong> ${result.data.nome_profissao}</p>
                                <p><strong>Custo por trabalho:</strong> ${result.data.custo_trabalho}</p>
                            `;
                            break;

                        case 'atividades_trabalhador':
                            cardContent = `
                                <h5 class="card-title">Atividade do Trabalhador</h5>
                                <div class="activity-details">
                                    <p><strong>Trabalhador:</strong> ${result.data.nome_trabalhador}</p>
                                    <p><strong>Fazenda:</strong> ${result.data.nome_fazenda}</p>
                                    <p><strong>Campo:</strong> ${result.data.nome_campo}</p>
                                    <p><strong>Data:</strong> ${result.data.data}</p>
                                    <p><strong>Hora Inicial:</strong> ${result.data.hora_inicial}</p>
                                    <p><strong>Duração:</strong> ${result.data.duracao} horas</p>
                                    <p><strong>Tipo de Atividade:</strong> ${result.data.tipo_atividade}</p>
                                    <p><strong>Custo Unitário:</strong> ${result.data.custo_unitario}</p>
                                    <p><strong>Valor do Trabalho:</strong> ${result.data.valor_trabalho}</p>
                                </div>
                            `;
                            break;

                        case 'atividade_colheitas':
                            cardContent = `
                                <h5 class="card-title">Atividade de Colheita</h5>
                                <div class="activity-details">
                                    <p><strong>Fazenda:</strong> ${result.data.nome_fazenda}</p>
                                    <p><strong>Campo:</strong> ${result.data.nome_campo}</p>
                                    <p><strong>Data:</strong> ${result.data.data}</p>
                                    <p><strong>Hora Inicial:</strong> ${result.data.hora_inicial}</p>
                                    <p><strong>Hora Final:</strong> ${result.data.hora_final}</p>
                                </div>
                            `;
                            break;

                        case 'paises':
                            cardContent = `
                                <h5 class="card-title">País</h5>
                                <p><strong>Nome:</strong> ${result.data.nome}</p>
                            `;
                            break;

                        case 'provincias':
                            cardContent = `
                                <h5 class="card-title">Província</h5>
                                <p><strong>Nome:</strong> ${result.data.nome}</p>
                                <p><strong>País:</strong> ${result.data.nome_pais}</p>
                            `;
                            break;

                        // Mantendo os demais casos existentes
                        case 'produtos':
                            cardContent = `
                                <h5 class="card-title">Produto: ${result.data.nome_produto}</h5>
                                <p><strong>Código do Produto:</strong> ${result.data.cod_produto}</p>
                            `;
                            break;

                        case 'users':
                            cardContent = `
                                <h5 class="card-title">Usuário: ${result.data.name}</h5>
                                <p><strong>Email:</strong> ${result.data.email}</p>
                            `;
                            break;

                        case 'equipamentos':
                            cardContent = `
                                <h5 class="card-title">Número do Equipamento: ${result.data.numero_equipamento}</h5>
                                <p><strong>Nome do Equipamento:</strong> ${result.data.nome_equipamento}</p>
                                <p><strong>Vida Útil:</strong> ${result.data.vida_util}</p>
                            `;
                            break;

                        case 'abastecimentos':
                            cardContent = `
                                <h5 class="card-title" style="font-weight: bold;">Nome do Equipamento: ${result.data.nome_equipamento}</h5>
                                <p>Produto: ${result.data.produto}</p>
                                <p>Data de Abastecimento: ${result.data.data_abastecimento}</p>
                            `;
                            break;

                        case 'atividades_maquinas':
                            cardContent = `
                                <h4 class="card-title" style="font-weight: bold;">Equipamento Associado: ${result.data.nome_equipamento}</h4>
                                <p>Fazenda Associada: ${result.data.nome_fazenda}</p>
                                <p>Campo Associado: ${result.data.nome_campo}</p>
                                <p>Tipo de Actividade: ${result.data.tipo_atividade}</p>
                            `;
                            break;

                        default:
                            cardContent = `
                                <h5 class="card-title">Resultado:</h5>
                                <pre class="card-text">${JSON.stringify(result.data, null, 2)}</pre>
                            `;
                    }

                    card.innerHTML = `<div class="card-body">${cardContent}</div>`;
                    resultsContainer.appendChild(card);
                });
            })
            .catch(error => {
                loadingSpinner.style.display = 'none';
                console.error('Erro:', error);
                resultsContainer.innerHTML = '<p>Ocorreu um erro ao buscar os resultados.</p>';
            });
    });
</script>

@endsection