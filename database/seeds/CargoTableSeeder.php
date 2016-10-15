<?php

/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 20:40
 */

use Illuminate\Database\Seeder;
class CargoTableSeeder extends Seeder
{
    public function run()
    {
        factory(\BibliotecaConcurseiro\Entities\Cargo::class, 100)->create();

    }

}