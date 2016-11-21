<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 16/10/2016
 * Time: 12:30
 */

namespace BibliotecaConcurseiro\Factories;
use BibliotecaConcurseiro\Factories\BancaFactory;

class ConcursoFactory
{
    public static function convert($concurso){
        $converted = [];
        if($concurso){
            $converted = [
                'id' => $concurso->id,
                'ano' => $concurso->ano,
                'orgao' => $concurso->orgao ? OrgaoFactory::convert($concurso->orgao) : "",
                'banca' => $concurso->orgao ? BancaFactory::convert($concurso->banca) : ""
            ];
            if($converted['orgao'] === ''){
                unset($converted['orgao']);
            }
            if($converted['banca'] === ''){
                unset($converted['banca']);
            }
        }
        return $converted;
    }
    public static function convertConcursoList($concursoList)
    {
        $converted = [];

        if ($concursoList) {
            foreach ($concursoList as $key => $value) {
                $converted[] = [
                    'id' => $value->id,
                    'ano' => $value->ano,
                    'orgao' => OrgaoFactory::convert($value->orgao),
                    'banca' => BancaFactory::convert($value->banca)
                ];
            }
        }
        return $converted;
    }

}