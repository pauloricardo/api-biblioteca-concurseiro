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
                'name' => $usuario->name,
                'email' => $usuario->email,
                'password' => $usuario->password
            ];
        }else{
            $converted = [
                'id' => null,
                'name' => null,
                'email' => null,
                'password' => null
            ];
        }
        return $converted;
    }
    public static function convertBack($usuario){
        $converted = [];
        if($usuario){
            $converted = [
                'id' => isset($usuario->id) ? $usuario->id : null,
                'name' => $usuario->name,
                'email' => $usuario->email,
                'password' => $usuario->password
            ];
        }else{
            $converted = [
                'id' => null,
                'name' => null,
                'email' => null,
                'password' => null,
            ];
        }
        return $converted;
    }
    public static function convertObject($object, $usuario){
        $object->id = $usuario->id;
        $object->email = $usuario->disciplina_id;
        $object->name = $usuario->name;
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