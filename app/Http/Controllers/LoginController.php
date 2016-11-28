<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 25/11/2016
 * Time: 15:14
 */

namespace BibliotecaConcurseiro\Http\Controllers;
use Illuminate\Http\Request;
use BibliotecaConcurseiro\Auth\User;
use BibliotecaConcurseiro\Auth\Proxy;


class LoginController extends Controller
{
    public function index(Request $request){
        $data = $request->all();
        $credentials['login'] = $data['email'];
        $credentials['password'] = $data['password'];

        $proxy = new Proxy();
        return $proxy->attemptLogin($credentials);

    }
}