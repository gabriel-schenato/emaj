<?php

use Emaj\Entities\Cadastro\Telefone;
use Faker\Generator as Faker;

/*
  |--------------------------------------------------------------------------
  | Model Factories
  |--------------------------------------------------------------------------
  |
  | This directory should contain each of the model factory definitions for
  | your application. Factories provide a convenient way to generate new
  | model instances for testing / seeding your application's database.
  |
 */

$factory->define(Telefone::class, function (Faker $faker) {
    $tipo = ['Celular', 'Residencial'];
    $tipoTelefone = $tipo[random_int(0, 1)];

    return [
        'tipo' => $tipoTelefone,
        'descricao' => $faker->safeColorName,
        'telefone' => $tipoTelefone == 'Celular' ? $faker->numerify('(##) #####-####') : $faker->numerify('(##) ####-####'),
    ];
});
