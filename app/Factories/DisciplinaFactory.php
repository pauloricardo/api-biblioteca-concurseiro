<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 16/10/2016
 * Time: 12:25
 */

namespace BibliotecaConcurseiro\Factories;


class DisciplinaFactory
{
    public static function convert($disciplina){
        $convert = [];
        if($disciplina){
            $converted = [
                'id' => $disciplina->id,
                'nome' => $disciplina->nome
            ];
        }else{
            $converted = [
                'id' => null,
                'nome' => null
            ];
        }
        return $converted;
    }
}