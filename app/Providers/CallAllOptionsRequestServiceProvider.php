<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 26/11/2016
 * Time: 22:13
 */

namespace BibliotecaConcurseiro\Providers;

use Illuminate\Support\ServiceProvider;

class CallAllOptionsRequestServiceProvider extends ServiceProvider
{
    public function register()
    {
        $request = app('request');

        if ($request->isMethod('OPTIONS'))
        {
            app()->options($request->path(), function() { return response('', 200); });
        }
    }

}