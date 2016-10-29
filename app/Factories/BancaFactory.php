<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 16/10/2016
 * Time: 12:31
 */

namespace BibliotecaConcurseiro\Factories;


class BancaFactory
{
    public static function convert($banca = null){
        $convert = [];
        if($banca){
            $converted = [
                'id' => $banca->id,
                'nome' => $banca->nome
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