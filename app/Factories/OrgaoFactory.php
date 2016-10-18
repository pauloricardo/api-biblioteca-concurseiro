<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 16/10/2016
 * Time: 12:31
 */

namespace BibliotecaConcurseiro\Factories;


class OrgaoFactory
{
    public static function convert($orgao = null){
        $convert = [];
        if($orgao){
            $converted = [
                'id' => $orgao->id,
                'nome' => $orgao->nome
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