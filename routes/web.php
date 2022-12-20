<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', 'App\Http\Controllers\LoginController@login')->name('login');

session_start();

// USUÁRIO LOGADO
if(isset($_SESSION['usuario']))
{
    // NÃO ENCONTRADO
    Route::get('error', function(){ return view('components.error'); })->name('error');

    // LOGOUT
    Route::post('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');

    // HOMEPAGE
    Route::get('/', function () {
        return view('home');
    })->name('home');

    // AGENDA
    Route::get('agendas', 'App\Http\Controllers\AgendasController@getAgendas')->name('getAgendas');
    Route::get('agendas/{agenda_id}', 'App\Http\Controllers\AgendasController@getAgenda')->name('getAgenda');
    Route::get('all/agendas', 'App\Http\Controllers\AgendasController@getAllAgenda')->name('getAllAgenda');
    Route::get('agendar', 'App\Http\Controllers\AgendasController@getAgendamento')->name('getAgendamento');
    Route::post('agendar', 'App\Http\Controllers\AgendasController@postAgendamento')->name('postAgendamento');
    Route::get('calendario', 'App\Http\Controllers\AgendasController@getCalendario')->name('getCalendario');
    Route::get('calendario-all', 'App\Http\Controllers\AgendasController@getCalendarioAll')->name('getCalendarioAll');

    // ARQUIVOS
    Route::get('arquivos', 'App\Http\Controllers\ArquivosController@getArquivos')->name('getArquivos');
    Route::get('arquivos/criar', function(){ return view('arquivos.criar'); })->name('getCriaArquivos');
    Route::get('arquivos/criador', 'App\Http\Controllers\ArquivosController@viewArquivo')->name('viewArquivo');

    // CONVÊNIOS
    Route::get('convenios', 'App\Http\Controllers\ConveniosController@getConvenios')->name('getConvenios');
    Route::get('convenios/criar', function(){ return view('convenios.criar'); })->name('getCriaConvenios');
    Route::post('convenios/criar', 'App\Http\Controllers\ConveniosController@criaConvenios')->name('postCriaConvenios');
    Route::get('convenios/editar/{convenio_id}', 'App\Http\Controllers\ConveniosController@getEditaConvenios')->name('getEditaConvenios');
    Route::post('convenios/editar/{convenio_id}', 'App\Http\Controllers\ConveniosController@postEditaConvenios')->name('postEditaConvenios');
    Route::post('convenios/deleta/{convenio_id}', 'App\Http\Controllers\ConveniosController@postDeletaConvenios')->name('postDeletaConvenios');

    // FINANCEIRO
    Route::get('financeiro', function(){ return redirect()->route('getFinanceiroMensal'); })->name('getFinanceiro');
    Route::get('financeiro/diario', function(){ return view('financeiro.diario'); })->name('getFinanceiroDiario');
    Route::post('financeiro/diario', 'App\Http\Controllers\FinanceiroController@postFinanceiroDiario')->name('postFinanceiroDiario');
    Route::get('financeiro/semanal', function(){ return view('financeiro.semanal'); })->name('getFinanceiroSemanal');
    Route::post('financeiro/semanal', 'App\Http\Controllers\FinanceiroController@postFinanceiroSemanal')->name('postFinanceiroSemanal');
    Route::get('financeiro/mensal', function(){ return view('financeiro.mensal'); })->name('getFinanceiroMensal');
    Route::post('financeiro/mensal', 'App\Http\Controllers\FinanceiroController@postFinanceiroMensal')->name('postFinanceiroMensal');
    Route::get('financeiro/anual', function(){ return view('financeiro.anual'); })->name('getFinanceiroAnual');
    Route::post('financeiro/anual', 'App\Http\Controllers\FinanceiroController@postFinanceiroAnual')->name('postFinanceiroAnual');

    // INSUMOS
    Route::get('insumos', 'App\Http\Controllers\InsumosController@getInsumos')->name('getInsumos');
    Route::get('insumos/estoque/adicionar',  'App\Http\Controllers\InsumosController@getCriaEstoque')->name('getCriaEstoque');
    Route::post('insumos/estoque/adicionar', 'App\Http\Controllers\InsumosController@postCriaEstoque')->name('postCriaEstoque');
    Route::get('insumos/estoque/editar/{estoque_id}', 'App\Http\Controllers\InsumosController@getEditaEstoque')->name('getEditaEstoque');
    Route::post('insumos/estoque/editar/{estoque_id}', 'App\Http\Controllers\InsumosController@postEditaEstoque')->name('postEditaEstoque');
    Route::get('insumos/materiais', 'App\Http\Controllers\InsumosController@getMateriais')->name('getMateriais');
    Route::get('insumos/materiais/criar',  function(){ return view('insumos.materiais.criar'); })->name('getCriaMateriais');
    Route::post('insumos/materiais/criar', 'App\Http\Controllers\InsumosController@criaMateriais')->name('postCriaMateriais');
    Route::get('insumos/materiais/editar/{material_id}', 'App\Http\Controllers\InsumosController@getEditaMateriais')->name('getEditaMateriais');
    Route::post('insumos/materiais/editar/{material_id}', 'App\Http\Controllers\InsumosController@postEditaMateriais')->name('postEditaMateriais');

    // PACIENTES
    Route::get('pacientes', 'App\Http\Controllers\PacientesController@getPacientes')->name('getPacientes');
    Route::get('pacientes/criar', 'App\Http\Controllers\PacientesController@getCriaPacientes')->name('getCriaPacientes');
    Route::post('pacientes/criar', 'App\Http\Controllers\PacientesController@postCriaPacientes')->name('postCriaPacientes');
    Route::get('pacientes/editar/{pacientes_id}', 'App\Http\Controllers\PacientesController@getEditaPacientes')->name('getEditaPacientes');
    Route::post('pacientes/editar/{pacientes_id}', 'App\Http\Controllers\PacientesController@postEditaPacientes')->name('postEditaPacientes');
    Route::get('pacientes/pesquisa', 'App\Http\Controllers\PacientesController@getPesquisaPacientes')->name('getPesquisaPacientes');

    // PROFISSIONAIS
    Route::get('profissionais', 'App\Http\Controllers\ProfissionaisController@getProfissionais')->name('getProfissionais');
    Route::get('profissionais/criar', function(){ return view('profissionais.criar'); })->name('getCriaProfissionais');
    Route::post('profissionais/criar', 'App\Http\Controllers\ProfissionaisController@criaProfissionais')->name('postCriaProfissionais');
    Route::get('profissionais/editar/{profissionais_id}', 'App\Http\Controllers\ProfissionaisController@getEditaProfissionais')->name('getEditaProfissionais');
    Route::post('profissionais/editar/{profissionais_id}', 'App\Http\Controllers\ProfissionaisController@postEditaProfissionais')->name('postEditaProfissionais');
    Route::post('profissionais/deleta/{profissionais_id}', 'App\Http\Controllers\ProfissionaisController@postDeletaProfissionais')->name('postDeletaProfissionais');

    // PROCEDIMENTOS
    Route::get('procedimentos', 'App\Http\Controllers\ProcedimentosController@getProcedimentos')->name('getProcedimentos');
    Route::get('procedimentos/criar', function(){ return view('procedimentos.criar'); })->name('getCriaProcedimentos');
    Route::post('procedimentos/criar', 'App\Http\Controllers\ProcedimentosController@criaProcedimentos')->name('postCriaProcedimentos');
    Route::get('procedimentos/editar/{procedimentos_id}', 'App\Http\Controllers\ProcedimentosController@getEditaProcedimentos')->name('getEditaProcedimentos');
    Route::post('procedimentos/editar/{procedimentos_id}', 'App\Http\Controllers\ProcedimentosController@postEditaProcedimentos')->name('postEditaProcedimentos');
    Route::post('procedimentos/deleta/{procedimentos_id}', 'App\Http\Controllers\ProcedimentosController@postDeletaProcedimentos')->name('postDeletaProcedimentos');

    // RELATÓRIOS
    // Route::get('relatorios', 'App\Http\Controllers\RelatoriosController')->name('relatorios');

    // USUÁRIOS
    Route::get('usuarios', 'App\Http\Controllers\UsuariosController@getUsuarios')->name('getUsuarios');
    Route::get('usuarios/criar', 'App\Http\Controllers\UsuariosController@getCriaUsuarios')->name('getCriaUsuarios');
    Route::post('usuarios/criar', 'App\Http\Controllers\UsuariosController@criaUsuarios')->name('postCriaUsuarios');
    Route::get('usuarios/editar/{usuarios_id}', 'App\Http\Controllers\UsuariosController@getEditaUsuarios')->name('getEditaUsuarios');
    Route::post('usuarios/editar/{usuarios_id}', 'App\Http\Controllers\UsuariosController@postEditaUsuarios')->name('postEditaUsuarios');
    Route::post('usuarios/deleta/{usuarios_id}', 'App\Http\Controllers\UsuariosController@postDeletaUsuarios')->name('postDeletaUsuarios');

}else{ // USUARIO NÃO LOGADO
    Route::get('/', function () { return view('welcome'); })->name('home');
    Route::get('agendas', function () { return redirect()->route('home'); })->name('getAgendas');
    Route::get('agendas/{agenda_id}', function () { return redirect()->route('home'); })->name('getAgenda');
    Route::get('all/agendas', function () { return redirect()->route('home'); })->name('getAllAgenda');
    Route::get('agendar', function () { return redirect()->route('home'); })->name('getAgendamento');
    Route::get('calendario', function () { return redirect()->route('home'); })->name('getCalendario');
    Route::get('calendario-all', function () { return redirect()->route('home'); })->name('getCalendarioAll');
    Route::get('arquivos', function () { return redirect()->route('home'); })->name('getArquivos');
    Route::get('arquivos/criar', function () { return redirect()->route('home'); })->name('getCriaArquivos');
    Route::get('arquivos/criador', function () { return redirect()->route('home'); })->name('viewArquivo');
    Route::get('convenios', function () { return redirect()->route('home'); })->name('getConvenios');
    Route::get('convenios/criar', function () { return redirect()->route('home'); })->name('getCriaConvenios');
    Route::get('convenios/editar/{convenio_id}', function () { return redirect()->route('home'); })->name('getEditaConvenios');
    Route::get('financeiro', function () { return redirect()->route('home'); })->name('getFinanceiro');
    Route::get('financeiro/diario', function () { return redirect()->route('home'); })->name('getFinanceiroDiario');
    Route::get('financeiro/semanal', function () { return redirect()->route('home'); })->name('getFinanceiroSemanal');
    Route::get('financeiro/mensal', function () { return redirect()->route('home'); })->name('getFinanceiroMensal');
    Route::get('financeiro/anual', function () { return redirect()->route('home'); })->name('getFinanceiroAnual');
    Route::get('insumos', function () { return redirect()->route('home'); })->name('getInsumos');
    Route::get('insumos/estoque/adicionar', function () { return redirect()->route('home'); })->name('getCriaEstoque');
    Route::get('insumos/estoque/editar/{estoque_id}', function () { return redirect()->route('home'); })->name('getEditaEstoque');
    Route::get('insumos/materiais', function () { return redirect()->route('home'); })->name('getMateriais');
    Route::get('insumos/materiais/criar', function () { return redirect()->route('home'); })->name('getCriaMateriais');
    Route::get('insumos/materiais/editar/{material_id}', function () { return redirect()->route('home'); })->name('getEditaMateriais');
    Route::get('pacientes', function () { return redirect()->route('home'); })->name('getPacientes');
    Route::get('pacientes/criar', function () { return redirect()->route('home'); })->name('getCriaPacientes');
    Route::get('pacientes/editar/{pacientes_id}', function () { return redirect()->route('home'); })->name('getEditaPacientes');
    Route::get('pacientes/pesquisa', function () { return redirect()->route('home'); })->name('getPesquisaPacientes');
    Route::get('profissionais', function () { return redirect()->route('home'); })->name('getProfissionais');
    Route::get('profissionais/criar', function () { return redirect()->route('home'); })->name('getCriaProfissionais');
    Route::get('profissionais/editar/{profissionais_id}', function () { return redirect()->route('home'); })->name('getEditaProfissionais');
    Route::get('procedimentos', function () { return redirect()->route('home'); })->name('getProcedimentos');
    Route::get('procedimentos/criar', function () { return redirect()->route('home'); })->name('getCriaProcedimentos');
    Route::get('procedimentos/editar/{procedimentos_id}', function () { return redirect()->route('home'); })->name('getEditaProcedimentos');
    Route::get('usuarios', function () { return redirect()->route('home'); })->name('getUsuarios');
    Route::get('usuarios/criar', function () { return redirect()->route('home'); })->name('getCriaUsuarios');
    Route::get('usuarios/editar/{usuarios_id}', function () { return redirect()->route('home'); })->name('getEditaUsuarios');
}