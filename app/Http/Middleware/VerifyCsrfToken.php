<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 25/11/2016
 * Time: 18:59
 */

namespace BibliotecaConcurseiro\Http\Middleware;
use Laravel\Lumen\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Closure;
class VerifyCsrfToken extends BaseVerifier
{
    protected $except = [
        'oauth/access-token'
    ];
    public function handle($request, Closure $next)
    {
        return $next($request);
    }


}