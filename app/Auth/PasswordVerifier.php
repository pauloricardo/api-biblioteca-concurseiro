<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 25/11/2016
 * Time: 18:23
 */

namespace BibliotecaConcurseiro\Auth;


use Illuminate\Support\Facades\Auth;

class PasswordVerifier
{
    public function verify($username, $password){
        $credentials = [
            'email' => $username,
            'password' => $password
        ];
        if(Auth::once($credentials)){
            return Auth::user()->id;
        }
        return false;
    }
}