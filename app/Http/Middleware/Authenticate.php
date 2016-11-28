<?php

namespace BibliotecaConcurseiro\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\Authenticate as Auth;

class Authenticate extends Auth
{

    public function handle($request, Closure $next, $guard = null)
    {
        $this->authenticate($request);
        return $next($request);
    }

    public function authenticate(Request $request)
    {
        $this->checkForToken($request);

        $tokenFetch = $this->auth->parseToken()->authenticate();
        try {
        } catch (JWTException $e) {
            throw new UnauthorizedHttpException('jwt-auth', $e->getMessage(), $e, $e->getCode());
        }
    }
}
