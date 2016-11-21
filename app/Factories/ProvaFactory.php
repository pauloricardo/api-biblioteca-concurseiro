<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 16/10/2016
 * Time: 12:31
 */

namespace BibliotecaConcurseiro\Factories;


class ProvaFactory
{
    public static function convert($prova){
        $converted = [];
        if($prova){
            $converted = [
                'id' => isset($prova->id) ? $prova->id : null,
                'concurso_id' => $prova->concurso_id,
                'cargo_id' => $prova->cargo_id,
                'cargo' => $prova->cargo,
                'concurso' => [
                    'nome' => $prova->concurso->orgao->nome . '/' . $prova->concurso->ano
                ],
                'nome' => $prova->nome
            ];
        }else{
            $converted = [
                'id' => null,
                'concurso_id' => null,
                'cargo_id' => null,
                'cargo' => null,
                'concurso' => null,
                'nome' => null
            ];
        }
        return $converted;
    }
    public static function convertBack($prova){
        $converted = [];
        if($prova){
            $converted = [
                'id' => isset($prova->id) ? $prova->id : null,
                'concurso_id' => $prova->concurso_id,
                'cargo_id' => $prova->cargo_id,
                'nome' => $prova->nome
            ];
        }else{
            $converted = [
                'id' => null,
                'concurso_id' => null,
                'cargo_id' => null,
                'nome' => null
            ];
        }
        return $converted;
    }
    public static function convertObject($object, $prova){
        $object->id = $prova->id;
        $object->concurso_id = $prova->concurso_id;
        $object->cargo_id = $prova->cargo_id;
        $object->nome  = $prova->nome;
    }
    public static function convertList($list)
    {
        $converted = [];

        if ($list) {
            foreach ($list as $key => $value) {
                $converted[] = ProvaFactory::convert($value);
            }
        }
        return $converted;
    }
}