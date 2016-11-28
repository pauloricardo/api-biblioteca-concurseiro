<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 26/11/2016
 * Time: 13:47
 */

namespace BibliotecaConcurseiro\Http\Middleware;
use Illuminate\Cookie\Middleware\EncryptCookies as Cookies;
use Closure;
class EncryptCookies extends Cookies
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

}