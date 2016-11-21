<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 16/10/2016
 * Time: 12:31
 */

namespace BibliotecaConcurseiro\Factories;


class AssuntoFactory
{
    public static function convert($assunto = null){
        $convert = [];
        if($assunto){
            $converted = [
                'id' => $assunto->id,
                'disciplina' => $assunto->disciplina,
                'disciplina_id' => $assunto->disciplina_id,
                'nome' => $assunto->nome
            ];
        }else{
            $converted = [
                'id' => null,
                'disciplina_id' => null,
                'nome' => null
            ];
        }
        return $converted;
    }
    public static function convertBack($assunto){
        $converted = [];
        if($assunto){
            $converted = [
                'id' => isset($assunto->id) ? $assunto->id : null,
                'disciplina_id' => $assunto->disciplina_id,
                'nome' => $assunto->nome
            ];
        }else{
            $converted = [
                'id' => null,
                'disciplina_id' => null,
                'nome' => null
            ];
        }
        return $converted;
    }

    public static function convertObject($object, $assunto){
        $object->id = $assunto->id;
        $object->disciplina_id = $assunto->disciplina_id;
        $object->nome = $assunto->nome;
    }
    public static function convertList($list)
    {
        $converted = [];

        if ($list) {
            foreach ($list as $key => $value) {
                $converted[] = AssuntoFactory::convert($value);
            }
        }
        return $converted;
    }
}