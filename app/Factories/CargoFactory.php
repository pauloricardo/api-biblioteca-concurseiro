<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 16/10/2016
 * Time: 12:28
 */

namespace BibliotecaConcurseiro\Factories;


class CargoFactory
{
    public static function convert($cargo){
        $converted = [];
        if($cargo){
            $converted = [
                'id' => $cargo->id,
                'nome' => $cargo->nome
            ];
        }
        return $converted;
    }

}