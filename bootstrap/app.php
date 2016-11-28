<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../')
);

 $app->withFacades();

 $app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    BibliotecaConcurseiro\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    BibliotecaConcurseiro\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

 $app->middleware([
//    App\Http\Middleware\ExampleMiddleware::class
\BibliotecaConcurseiro\Http\Middleware\CorsMiddleware::class
 ]);

// $app->routeMiddleware([
//     'auth' => App\Http\Middleware\Authenticate::class,
// ]);
$app->routeMiddleware([
    'jwt-auth' => \BibliotecaConcurseiro\Http\Middleware\Authenticate::class,
    'cors' => \BibliotecaConcurseiro\Http\Middleware\CorsMiddleware::class,
    'cors.options' => \BibliotecaConcurseiro\Http\Middleware\CorsOptionsMiddleware::class
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

// $app->register(App\Providers\AppServiceProvider::class);
// $app->register(App\Providers\AuthServiceProvider::class);
// $app->register(App\Providers\EventServiceProvider::class);
$app->withFacades();
$app->register(Tymon\JWTAuth\Providers\LumenServiceProvider::class);
$app->register(BibliotecaConcurseiro\Providers\AppServiceProvider::class);
$app->register(\BibliotecaConcurseiro\Providers\CallAllOptionsRequestServiceProvider::class);

//$app->register(Tymon\JWTAuth\Providers\Storage\IlluminateCacheAdapter::class);
//$app->alias('Cache', 'Illuminate\Cache\CacheManager');
//$app->alias('Auth', 'Illuminate\Auth\AuthManager');
$app->configure('jwt');

//class_alias('Tymon\JWTAuth\Facades\JWTFactory', 'JWTFactory');
//class_alias('Illuminate\Cache\CacheManager', 'Cache');
//class_alias('Illuminate\Support\Facades\Config', 'Config');
/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->group(['namespace' => 'BibliotecaConcurseiro\Http\Controllers'], function ($app) {
    require __DIR__.'/../routes/web.php';
});

return $app;
