<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 26/11/2016
 * Time: 21:47
 */

namespace BibliotecaConcurseiro\Http\Middleware;
use Closure;

class CorsOptionsMiddleware {
public function handle($request, Closure $next)
{
    return $next($request)
        ->header('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN'])
        ->header('Access-Control-Allow-Methods', 'PUT, POST, DELETE')
        ->header('Access-Control-Allow-Headers', 'Accept, Content-Type,X-CSRF-TOKEN,Authorization')
        ->header('Access-Control-Allow-Credentials', 'true');
}}