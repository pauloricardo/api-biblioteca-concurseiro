<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(BibliotecaConcurseiro\Entities\Cargo::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name
    ];
});
$factory->define(BibliotecaConcurseiro\Entities\Assunto::class, function (Faker\Generator $faker) {
    return [
        'disciplina_id' => rand(1,100),
        'nome' => $faker->name
    ];
});
$factory->define(BibliotecaConcurseiro\Entities\Prova::class, function (Faker\Generator $faker) {
    return [
        'cargo_id' => rand(1,100),
        'concurso_id' => rand(1,100),
        'nome' => $faker->name
    ];
});
$factory->define(\BibliotecaConcurseiro\Entities\Disciplina::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name
    ];
});
$factory->define(BibliotecaConcurseiro\Entities\Banca::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name
    ];
});
$factory->define(BibliotecaConcurseiro\Entities\Orgao::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name
    ];
});
$factory->define(BibliotecaConcurseiro\Entities\Concurso::class, function (Faker\Generator $faker) {
    return [
        'ano' => $faker->date('Y'),
        'orgao_id' => rand(1,100),
        'banca_id' => rand(1,100)
    ];
});
$factory->define(BibliotecaConcurseiro\Entities\Questao::class, function (Faker\Generator $faker) {
    return [
        'concurso_id' => rand(1,100),
        'disciplina_id' => rand(1,100),
        'cargo_id' => rand(1,100),
        'multipla_escolha' => $faker->boolean(),
        'tipo_questao' => rand(1,2),
        'texto' => $faker->text('512'),
        'texto_auxiliar' => $faker->text('512')
    ];
});
$factory->define(BibliotecaConcurseiro\Entities\QuestaoResposta::class, function (Faker\Generator $faker) {
    return [
        'questao_id' => rand(1,100),
        'disciplina_id' => rand(1,100),
        'enunciado' => $faker->text('256'),
        'correta' => $faker->boolean
    ];
});
