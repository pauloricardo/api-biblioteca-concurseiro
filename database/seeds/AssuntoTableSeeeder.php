<?php

/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 20:40
 */

use Illuminate\Database\Seeder;
class AssuntoTableSeeder extends Seeder
{
    public function run()
    {
        factory(\BibliotecaConcurseiro\Entities\Assunto::class, 100)->create();

    }

}