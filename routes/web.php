<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrabalhadorController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\LocalizacaoController;
use App\Http\Controllers\FazendaController;
use App\Http\Controllers\CampoCultivoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\AbastecimentoController;
use App\Http\Controllers\AtividadeMaquinaController;
use App\Http\Controllers\AtividadeColheitaController;
use App\Http\Controllers\AtividadeTrabalhadorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Rotas de acesso
Route::get('/register', [AccessController::class, 'RegisterPage'])->name('register')->middleware('guest');
Route::post('/register', [AccessController::class, 'RegisterProcess'])->middleware('guest');

Route::get('/login', [AccessController::class, 'LoginPage'])->name('login')->middleware('guest');
Route::post('/login', [AccessController::class, 'LoginProcess'])->middleware('guest');

Route::get('/forgot-password', [AccessController::class, 'showForgotPasswordForm'])->name('password.request')->middleware('guest');
Route::post('/forgot-password', [AccessController::class, 'sendResetLinkEmail'])->name('password.email')->middleware('guest');
Route::get('/reset-password/{token}', [AccessController::class, 'showResetPasswordForm'])->name('password.reset')->middleware('guest');
Route::post('/reset-password', [AccessController::class, 'resetPassword'])->name('password.update')->middleware('guest');

Route::post('/logout', [AccessController::class, 'logout'])->name('logout');

// Rotas de localização
Route::get('localizacoes', [LocalizacaoController::class, 'index'])->name('localizacoes.index');
Route::post('localizacoes/pais', [LocalizacaoController::class, 'storePais'])->name('localizacoes.storePais');
Route::post('localizacoes/provincia', [LocalizacaoController::class, 'storeProvincia'])->name('localizacoes.storeProvincia');
Route::post('localizacoes/municipio', [LocalizacaoController::class, 'storeMunicipio'])->name('localizacoes.storeMunicipio');
Route::delete('localizacoes/pais/{id}', [LocalizacaoController::class, 'destroyPais'])->name('localizacoes.destroyPais');
Route::delete('localizacoes/provincia/{id}', [LocalizacaoController::class, 'destroyProvincia'])->name('localizacoes.destroyProvincia');
Route::delete('localizacoes/municipio/{id}', [LocalizacaoController::class, 'destroyMunicipio'])->name('localizacoes.destroyMunicipio');

Route::get('/provincias/{pais_id}', [LocalizacaoController::class, 'getProvincias']);
Route::get('/municipios/{provincia_id}', [LocalizacaoController::class, 'getMunicipios']);

// Rotas do painel
Route::middleware(['auth'])->group(function () {
    // Rotas protegidas
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/search', [HomeController::class, 'showSearch'])->name('showSearch');
    Route::get('/search-results', [HomeController::class, 'search'])->name('search');

    // Rotas Trabalhador
    Route::get('/create-trabalhador', [TrabalhadorController::class, 'CreateTrabalhador'])->name('CreateTrabalhador');
    Route::post('/create-trabalhador', [TrabalhadorController::class, 'StoreTrabalhador'])->name('StoreTrabalhador');
    Route::get('/list-trabalhador', [TrabalhadorController::class, 'ListTrabalhador'])->name('ListTrabalhador');
    Route::get('/edit-trabalhador/{id}', [TrabalhadorController::class, 'EditTrabalhador'])->name('EditTrabalhador');
    Route::post('/update-trabalhador/{id}', [TrabalhadorController::class, 'UpdateTrabalhador'])->name('UpdateTrabalhador');
    Route::delete('/delete-trabalhador/{id}', [TrabalhadorController::class, 'DeleteTrabalhador'])->name('DeleteTrabalhador');

    // Rotas Equipamento
    Route::get('/create-equipamento', [EquipamentoController::class, 'CreateEquipamento'])->name('CreateEquipamento');
    Route::post('/create-equipamento', [EquipamentoController::class, 'StoreEquipamento'])->name('StoreEquipamento');
    Route::get('/list-equipamento', [EquipamentoController::class, 'ListEquipamento'])->name('ListEquipamento');
    Route::get('/edit-equipamento/{id}', [EquipamentoController::class, 'EditEquipamento'])->name('EditEquipamento');
    Route::post('/update-equipamento/{id}', [EquipamentoController::class, 'UpdateEquipamento'])->name('UpdateEquipamento');
    Route::delete('/delete-equipamento/{id}', [EquipamentoController::class, 'DeleteEquipamento'])->name('DeleteEquipamento');

    // Rotas Equipamento
    Route::resource('fazendas', FazendaController::class);

    // Rotas Campos de Cultivo
    Route::resource('campos-cultivo', CampoCultivoController::class);

    // Rotas Produtos
    Route::resource('produtos', ProdutoController::class);

    // Rotas Abastecimento
    Route::resource('abastecimentos', AbastecimentoController::class);

    // Rotas Atividade Maquina
    Route::resource('atividades-maquinas', AtividadeMaquinaController::class);
    Route::get('/obter_custo_hora', [EquipamentoController::class, 'obterCustoHora'])->name('obter_custo_hora');

    // Rotas Atividade Colheita
    Route::get('atividades-colheitas', [AtividadeColheitaController::class, 'index'])->name('atividades-colheitas.index');
    Route::post('atividades-colheitas', [AtividadeColheitaController::class, 'store'])->name('atividades-colheitas.store');
    Route::get('atividades-colheitas/{id}/edit', [AtividadeColheitaController::class, 'edit'])->name('atividades-colheitas.edit');
    Route::put('atividades-colheitas/{id}', [AtividadeColheitaController::class, 'update'])->name('atividades-colheitas.update');
    Route::delete('atividades-colheitas/{id}', [AtividadeColheitaController::class, 'destroy'])->name('atividades-colheitas.destroy');
    Route::get('obter-preco-produto-produto', [AtividadeColheitaController::class, 'obterPrecoProduto'])->name('obterPrecoProduto');

    // Rotas Atividade trabalhador
    Route::resource('atividades-trabalhador', AtividadeTrabalhadorController::class);
    Route::get('/obter_custo_trabalhador', [AtividadeTrabalhadorController::class, 'obterCustoTrabalhador'])->name('obterCustoTrabalhador');

});

