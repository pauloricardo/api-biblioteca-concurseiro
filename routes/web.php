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

$app->get('/api/v1/disciplinas/{skip}/{top}', 'DisciplinasController@index');
$app->get('/api/v1/disciplinas/', 'DisciplinasController@index');
$app->get('/api/v1/disciplinas/fn/trash/{id}', 'DisciplinasController@deleta');
$app->get('/api/v1/disciplinas/{id}', 'DisciplinasController@getDisciplina');
$app->post('/api/v1/disciplinas/', 'DisciplinasController@save');
$app->post('/api/v1/disciplinas/{id}', 'DisciplinasController@update');

$app->get('/api/v1/bancas/{skip}/{top}', 'BancasController@index');
$app->get('/api/v1/bancas/', 'BancasController@index');
$app->get('/api/v1/bancas/fn/trash/{id}', 'BancasController@deleta');
$app->get('/api/v1/bancas/{id}', 'BancasController@getBanca');
$app->post('/api/v1/bancas/', 'BancasController@save');
$app->post('/api/v1/bancas/{id}', 'BancasController@update');

$app->get('/api/v1/orgaos/{skip}/{top}', 'OrgaosController@index');
$app->get('/api/v1/orgaos/', 'OrgaosController@index');
$app->get('/api/v1/orgaos/fn/trash/{id}', 'OrgaosController@deleta');
$app->get('/api/v1/orgaos/{id}', 'OrgaosController@getOrgao');
$app->post('/api/v1/orgaos/', 'OrgaosController@save');
$app->post('/api/v1/orgaos/{id}', 'OrgaosController@update');

$app->get('/api/v1/cargos/{skip}/{top}', 'CargosController@index');
$app->get('/api/v1/cargos/', 'CargosController@index');
$app->get('/api/v1/cargos/fn/trash/{id}', 'CargosController@deleta');
$app->get('/api/v1/cargos/{id}', 'CargosController@getCargo');
$app->post('/api/v1/cargos/', 'CargosController@save');
$app->post('/api/v1/cargos/{id}', 'CargosController@update');

$app->get('/api/v1/concursos/{skip}/{top}', 'ConcursosController@index');
$app->get('/api/v1/concursos/', 'ConcursosController@index');
$app->get('/api/v1/concursos/fn/trash/{id}', 'ConcursosController@deleta');
$app->get('/api/v1/concursos/{id}', 'ConcursosController@getConcurso');
$app->post('/api/v1/concursos/', 'ConcursosController@save');
$app->post('/api/v1/concursos/{id}', 'ConcursosController@update');

$app->get('/api/v1/questoes/{skip}/{top}', 'QuestoesController@index');
$app->get('/api/v1/questoes/', 'QuestoesController@index');
$app->get('/api/v1/questoes/fn/trash/{id}', 'QuestoesController@deleta');
$app->get('/api/v1/questoes/{id}', 'QuestoesController@getQuestao');
$app->post('/api/v1/questoes/', 'QuestoesController@save');
$app->post('/api/v1/questoes/{id}', 'QuestoesController@update');
