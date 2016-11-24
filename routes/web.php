<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$app->post('login', function() use($app) {
    $credentials = app()->make('request')->input("credentials");
    return $app->make('App\Auth\Proxy')->attemptLogin($credentials);
});

$app->post('refresh-token', function() use($app) {
    return $app->make('App\Auth\Proxy')->attemptRefresh();
});

$app->post('oauth/access-token', function() use($app) {
    return response()->json($app->make('oauth2-server.authorizer')->issueAccessToken());
});

$app->group(['prefix'=>'api/v1', 'middleware'=>'oauth'], function($app){
  $app->get('disciplinas/{skip}/{top}', 'DisciplinasController@index');
  $app->get('disciplinas/', 'DisciplinasController@index');
  $app->get('disciplinas/fn/trash/{id}', 'DisciplinasController@deleta');
  $app->get('disciplinas/{id}', 'DisciplinasController@getDisciplina');
  $app->post('disciplinas/', 'DisciplinasController@save');
  $app->post('disciplinas/{id}', 'DisciplinasController@update');

  $app->get('bancas/{skip}/{top}', 'BancasController@index');

  $app->get('bancas/', 'BancasController@index');
  $app->get('bancas/fn/trash/{id}', 'BancasController@deleta');
  $app->get('bancas/{id}', 'BancasController@getBanca');
  $app->post('bancas/', 'BancasController@save');
  $app->post('bancas/{id}', 'BancasController@update');

  $app->get('provas/', 'ProvasController@index');
  $app->get('provas/{skip}/{top}', 'ProvasController@index');
  $app->get('provas/fn/trash/{id}', 'ProvasController@deleta');
  $app->get('provas/{id}', 'ProvasController@getProva');
  $app->post('provas/', 'ProvasController@save');
  $app->post('provas/{id}', 'ProvasController@update');

  $app->get('assuntos/', 'AssuntosController@index');
  $app->get('assuntos/{skip}/{top}', 'AssuntosController@index');
  $app->get('assuntos/fn/trash/{id}', 'AssuntosController@deleta');
  $app->get('assuntos/{id}', 'AssuntosController@getAssunto');
  $app->post('assuntos/', 'AssuntosController@save');
  $app->post('assuntos/{id}', 'AssuntosController@update');


  $app->get('orgaos/{skip}/{top}', 'OrgaosController@index');
  $app->get('orgaos/', 'OrgaosController@index');
  $app->get('orgaos/fn/trash/{id}', 'OrgaosController@deleta');
  $app->get('orgaos/{id}', 'OrgaosController@getOrgao');
  $app->post('orgaos/', 'OrgaosController@save');
  $app->post('orgaos/{id}', 'OrgaosController@update');

  $app->get('cargos/{skip}/{top}', 'CargosController@index');
  $app->get('cargos/', 'CargosController@index');
  $app->get('cargos/fn/trash/{id}', 'CargosController@deleta');
  $app->get('cargos/{id}', 'CargosController@getCargo');
  $app->post('cargos/', 'CargosController@save');
  $app->post('cargos/{id}', 'CargosController@update');

  $app->get('concursos/{skip}/{top}', 'ConcursosController@index');
  $app->get('concursos/', 'ConcursosController@index');
  $app->get('concursos/fn/trash/{id}', 'ConcursosController@deleta');
  $app->get('concursos/{id}', 'ConcursosController@getConcurso');
  $app->post('concursos/', 'ConcursosController@save');
  $app->post('concursos/{id}', 'ConcursosController@update');

  $app->get('questoes/{skip}/{top}/', 'QuestoesController@index');
  $app->get('questoes/{filtroDisciplina}/{filtroConcurso}/{skip}/{top}/', 'QuestoesController@index');
  $app->get('questoes/', 'QuestoesController@index');
  $app->get('questoes/fn/trash/{id}', 'QuestoesController@trash');
  $app->get('questoes/{id}', 'QuestoesController@getQuestao');
  $app->post('questoes/', 'QuestoesController@save');
  $app->post('questoes/uploadQuestaoFile', 'QuestoesController@uploadQuestaoFile');
  $app->post('questoes/{id}', 'QuestoesController@update');
});


/** ROTAS PÚBLICAS**/
$app->get('/api/v1/public/bancas', 'QuestoesPublicController@getBancas');
$app->get('/api/v1/public/assuntos', 'QuestoesPublicController@getAssuntos');
$app->get('/api/v1/public/instituicoes', 'QuestoesPublicController@getInstituicoes');
$app->get('/api/v1/public/provas', 'QuestoesPublicController@getProvas');
$app->get('/api/v1/public/cargos', 'QuestoesPublicController@getCargos');
$app->get('/api/v1/public/concursos', 'QuestoesPublicController@getConcursos');
$app->get('/api/v1/public/disciplinas', 'QuestoesPublicController@getDisciplinas');
$app->get('/api/v1/public/questoes', 'QuestoesPublicController@getQuestoes');
/** FIM 8*/
