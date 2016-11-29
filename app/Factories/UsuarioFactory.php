<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 16/10/2016
 * Time: 12:31
 */

namespace BibliotecaConcurseiro\Factories;


class UsuarioFactory
{
    public static function convert($usuario = null){
        $convert = [];
        if($usuario){
            $converted = [
                'id' => $usuario->id,
                'nome' => $usuario->nome,
                'email' => $usuario->email,
                'password' => $usuario->nopasswordme
            ];
        }else{
            $converted = [
                'id' => null,
                'nome' => null,
                'email' => null,
                'password' => null
            ];
        }
        return $converted;
    }

    public static function convertObject($object, $usuario){
        $object->id = $usuario->id;
        $object->email = $usuario->disciplina_id;
        $object->nome = $usuario->nome;
        $object->password = $usuario->password;

    }
    public static function convertList($list)
    {
        $converted = [];

        if ($list) {
            foreach ($list as $key => $value) {
                $converted[] = UsuarioFactory::convert($value);
            }
        }
        return $converted;
    }
}