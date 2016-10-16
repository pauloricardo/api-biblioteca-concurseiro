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
        'texto' => $faker->text('512')
    ];
});
