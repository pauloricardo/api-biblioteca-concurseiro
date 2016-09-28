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

$app->get('/api/v1/disciplinas', function () use ($app) {
    return file_get_contents($app->basePath() . '/resources/mocks/disciplinas.json');
});
$app->get('/api/v1/cargos', function () use ($app) {
    return file_get_contents($app->basePath() . '/resources/mocks/cargos.json');
});
$app->get('/api/v1/concursos', function () use ($app) {
    return file_get_contents($app->basePath() . '/resources/mocks/concursos.json');
});
$app->get('/api/v1/orgaos', function () use ($app) {
    return file_get_contents($app->basePath() . '/resources/mocks/orgaos.json');
});
$app->get('/api/v1/questoes', function () use ($app) {
    return file_get_contents($app->basePath() . '/resources/mocks/questoes.json');
});
