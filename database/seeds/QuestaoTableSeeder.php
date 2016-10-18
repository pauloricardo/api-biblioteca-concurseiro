<?php

/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 20:40
 */

use Illuminate\Database\Seeder;
class QuestaoTableSeeder extends Seeder
{
    public function run()
    {
        factory(\BibliotecaConcurseiro\Entities\Questao::class, 100)->create()->each(function($q){
            for($i = 0 ; $i < 4 ; $i++){
                factory(\BibliotecaConcurseiro\Entities\QuestaoResposta::class)->create();
            }
        });

    }

}